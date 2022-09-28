<?php

namespace Application\Controller;

use Application\Form\Admin as Form;
use Application\Helper\ConfigHelper;
use Application\Model\Command\PositionCommandInterface;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\PositionList;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\StatusRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Http\Header\Referer;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container as SessionContainer;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use LogicException;

class AdminController extends AbstractActionController
{
    private Form\PositionForm $positionForm;
    private Form\UserForm $userForm;
    private Form\AdminFilterForm $adminFilterForm;
    private UserRepositoryInterface $userRepository;
    private PositionRepositoryInterface $positionRepository;
    private UserCommandInterface $userCommand;
    private PositionCommandInterface $positionCommand;
    private SessionContainer $sessionContainer;
    private StatusRepositoryInterface $statusRepository;

    public function __construct(
        Form\PositionForm           $positionForm,
        Form\UserForm               $userForm,
        Form\AdminFilterForm        $adminFilterForm,
        UserRepositoryInterface     $userRepository,
        StatusRepositoryInterface   $statusRepository,
        PositionRepositoryInterface $positionRepository,
        UserCommandInterface        $userCommand,
        PositionCommandInterface    $positionCommand,
        SessionContainer            $sessionContainer
    ) {
        $this->positionForm = $positionForm;
        $this->userForm = $userForm;
        $this->adminFilterForm = $adminFilterForm;
        $this->userRepository = $userRepository;
        $this->statusRepository = $statusRepository;
        $this->positionRepository = $positionRepository;
        $this->userCommand = $userCommand;
        $this->positionCommand = $positionCommand;
        $this->sessionContainer = $sessionContainer;
    }

    public function viewUserListAction()
    {
        $userId = $this->sessionContainer->offsetGet(LoginController::USER_ID_KEY);
        if (!is_integer($userId)) {
            return $this->redirect()->toRoute('home');
        }

        if (!$this->statusRepository->checkStatusOfUser($userId, 'admin')) {
            return $this->redirect()->toRoute('user/view-profile');
        }

        $this->layout()->setVariables([
            'headTitleName' => 'List of users (Administrator)',
            'navbar'        => 'Laminas\Navigation\Admin',
        ]);

        return new ViewModel([
            'adminFilterForm' => $this->adminFilterForm,
        ]);
    }

    public function getUsersAction()
    {
        $userId = $this->sessionContainer->offsetGet(LoginController::USER_ID_KEY);
        if (!is_integer($userId)) {
            return $this->redirect()->toRoute('home');
        }

        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            throw new LogicException('The request to the address must be ajax and post.');
        }

        $data = $request->getPost()->toArray();
        parse_str($data['where'], $data['where']);
        $whereConfig = ConfigHelper::filterEmpty($data['where']);
        $orderConfig = $data['order'];
        $page = (integer)$data['page'];
        $offset = ($page - 1) * UserController::MAX_USER_COUNT;
        $limit = UserController::MAX_USER_COUNT;

        /** @var Referer $referer */
        $referer = $request->getHeader('Referer', null);
        $isAdminPage = is_null($referer) || strpos($referer->getUri(), 'admin') !== false;

        if (!$isAdminPage) {
            $whereConfig['active'] = ConfigHelper::YES_OPTION;
            if (isset($whereConfig['admin'])) {
                unset($whereConfig['admin']);
            }
        }

        $users = $this->userRepository->findUsers($whereConfig, $orderConfig);
        $userCount = count($users);

        $jsonData = [];

        $userList = array_slice($users, $offset, $limit);
        $userList = array_map(function ($item) use ($isAdminPage) {
            return $item->toArray($isAdminPage);
        }, $userList);

        $jsonData['userList'] = $userList;
        $jsonData['userCount'] = $userCount;

        if (isset($data['updatePage'])) {
            $pageCount = ceil($userCount / UserController::MAX_USER_COUNT);
            $jsonData['pageCount'] = $pageCount;
        }

        return new JsonModel($jsonData);
    }

    public function editUserAction()
    {
        $userId = (int)$this->params()->fromRoute('id', 0);

        if ($userId === 0) {
            return $this->redirect()->toRoute('admin/view-user-list');
        }

        try {
            $user = $this->userRepository->findUser($userId);
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('admin/view-user-list');
        }

        $this->layout()->setVariables([
            'headTitleName' => 'Edit user (Administrator)',
            'navbar'        => 'Laminas\Navigation\Admin',
        ]);

        $this->userForm->bind($user);
        $viewModel = new ViewModel(['userForm' => $this->userForm]);

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $viewModel;
        }

        $postData = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );

        $this->userForm->setData($postData);

        if (!$this->userForm->isValid()) {
            return $viewModel;
        }

        $this->userCommand->updateUser($user);
        return $this->redirect()->toRoute('admin/view-user-list');
    }

    public function editPositionsAction()
    {
        $this->layout()->setVariables([
            'headTitleName' => 'Position Management (Administrator)',
            'navbar'        => 'Laminas\Navigation\Admin',
        ]);

        $list = $this->positionRepository->findAllPositions();
        $positionList = new PositionList($list);
        $this->positionForm->bind($positionList);

        $viewModel = new ViewModel(['positionForm' => $this->positionForm]);

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $viewModel;
        }

        $this->positionForm->setData($request->getPost());

        if (!$this->positionForm->isValid()) {
            return $viewModel;
        }

        $this->positionCommand->updatePositions(
            $this->positionForm->getObject()
        );

        return $this->redirect()->toRoute('admin/edit-position');
    }
}

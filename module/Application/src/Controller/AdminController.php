<?php

namespace Application\Controller;

use Application\Form\Admin as Form;
use Application\Helper\ConfigHelper;
use Application\Model\Command\PositionCommandInterface;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\PositionList;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    private Form\PositionForm $positionForm;
    private Form\UserForm $userForm;
    private Form\AdminFilterForm $adminFilterForm;
    private UserRepositoryInterface $userRepository;
    private PositionRepositoryInterface $positionRepository;
    private UserCommandInterface $userCommand;
    private PositionCommandInterface $positionCommand;

    public function __construct(
        Form\PositionForm           $positionForm,
        Form\UserForm               $userForm,
        Form\AdminFilterForm        $adminFilterForm,
        UserRepositoryInterface     $userRepository,
        PositionRepositoryInterface $positionRepository,
        UserCommandInterface        $userCommand,
        PositionCommandInterface    $positionCommand
    ) {
        $this->positionForm = $positionForm;
        $this->userForm = $userForm;
        $this->adminFilterForm = $adminFilterForm;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->userCommand = $userCommand;
        $this->positionCommand = $positionCommand;
    }

    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Список пользователей (Администратор)');
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $viewModel->setVariables([
            'adminFilterForm' => $this->adminFilterForm,
        ]);

        return $viewModel;
    }

    public function getUsersAction()
    {
        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $data = $request->getPost()->toArray();
        parse_str($data['where'], $data['where']);
        $whereConfig = ConfigHelper::filterEmpty($data['where']);
        $orderConfig = $data['order'];
        $page = (integer)$data['page'];

        if (isset($data['updatePage'])) {
            $userCount = count(
                $this->userRepository->findUsers($whereConfig)
            );

            $viewModel = new ViewModel();
            $viewModel->setTerminal(true);
            $viewModel->setTemplate('partial/page-select.phtml');

            $viewModel->setVariables([
                'pageCount' => ceil($userCount / UserController::MAX_USER_COUNT),
            ]);

            return $viewModel;
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('partial/user-list.phtml');

        $viewModel->setVariables([
            'userList' => $this->userRepository->findUsers(
                $whereConfig,
                $orderConfig,
                true,
                $page
            ),
            'formName' => $data['formName'],
        ]);

        return $viewModel;
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
            'headTitleName' => 'Редактирование пользователя (Администратор)',
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
            'headTitleName' => 'Управление должностями (Администратор)',
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

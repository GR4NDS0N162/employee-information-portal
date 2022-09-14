<?php

namespace Application\Controller;

use Application\Form\Admin as Form;
use Application\Model\Command\PositionCommandInterface;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\PositionList;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public const maxPageCount = 5;
    public const userId = 1;

    /**
     * @var Form\PositionForm
     */
    private $positionForm;
    /**
     * @var Form\UserForm
     */
    private $userForm;
    /**
     * @var Form\AdminFilterForm
     */
    private $adminFilterForm;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;
    /**
     * @var UserCommandInterface
     */
    private $userCommand;
    /**
     * @var PositionCommandInterface
     */
    private $positionCommand;

    /**
     * @param Form\PositionForm           $positionForm
     * @param Form\UserForm               $userForm
     * @param Form\AdminFilterForm        $adminFilterForm
     * @param UserRepositoryInterface     $userRepository
     * @param PositionRepositoryInterface $positionRepository
     * @param UserCommandInterface        $userCommand
     * @param PositionCommandInterface    $positionCommand
     */
    public function __construct(
        $positionForm,
        $userForm,
        $adminFilterForm,
        $userRepository,
        $positionRepository,
        $userCommand,
        $positionCommand
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
            'userInfo'           => $this->userRepository->findUsers(),
            'positionRepository' => $this->positionRepository,
            'page'               => 1,
            'adminFilterForm'    => $this->adminFilterForm,
        ]);

        return $viewModel;
    }

    public function getUsersAction()
    {
        $request = $this->getRequest();

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('partial/user-list-admin.phtml');

        if (!$request->isXmlHttpRequest() && $request->isPost()) {
            return $viewModel;
        }

        $data = $request->getPost()->toArray();
        $form = array_filter(
            array_column(
                $data['form'],
                'value',
                'name'
            )
        );

        $page = (int)$form['page'];

        $order = [
            'u.surname',
            'u.name',
            'u.patronymic',
            'pos.name',
            'u.gender',
            'u.birthday DESC',
        ];
        if ($form['sort'] == 'position') {
            array_unshift($order, 'pos.name');
        } elseif ($form['sort'] == 'age') {
            array_unshift($order, 'u.birthday DESC');
        } elseif ($form['sort'] == 'gender') {
            array_unshift($order, 'u.gender');
        }
        $order = array_unique($order);

        $where = [];
        if (isset($form['active'])) {
            $sign = $form['active'] == '1' ? '=' : '!=';
            $where['s.name ' . $sign . ' ?'] = 'active';
        }
        if (isset($form['admin'])) {
            $sign = $form['active'] == '1' ? '=' : '!=';
            $where['s.name ' . $sign . ' ?'] = 'admin';
        }
        if (isset($form['age[min]'])) {
            $where[] = new Expression(
                'TIMESTAMPDIFF(YEAR, u.birthday, NOW()) > ?))',
                [$form['age[min]']]
            );
        }
        if (isset($form['age[max]'])) {
            $where[] = new Expression(
                'TIMESTAMPDIFF(YEAR, u.birthday, NOW()) < ?))',
                [$form['age[max]']]
            );
        }

        $viewModel->setVariables([
            'userList' => $this->userRepository->findUsers(
                $where,
                $order,
                true,
                $page
            ),
        ]);

        return $viewModel;
    }

    public function editUserAction()
    {
        $userId = (int)$this->params()->fromRoute('id');

        if (empty($userId)) {
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

        $this->userForm->setData($request->getPost());

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
            'navbar'        => 'Laminas\Navigation\Admin'
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

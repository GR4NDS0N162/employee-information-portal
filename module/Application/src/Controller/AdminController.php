<?php

namespace Application\Controller;

use Application\Form;
use Application\Form\Admin\AdminFilterForm;
use Application\Form\Admin\PositionForm;
use Application\Form\Admin\UserForm;
use Application\Model\PhotoUrlGenerator;
use Application\Model\UserCommandInterface;
use Application\Model\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public const maxPageCount = 20;

    /**
     * @var PositionForm
     */
    private $positionForm;

    /**
     * @var UserForm
     */
    private $userForm;

    /**
     * @var AdminFilterForm
     */
    private $adminFilterForm;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserCommandInterface
     */
    private $userCommand;

    public function __construct(
        PositionForm            $positionForm,
        UserForm                $userForm,
        AdminFilterForm         $adminFilterForm,
        UserRepositoryInterface $userRepository,
        UserCommandInterface    $userCommand
    ) {
        $this->positionForm = $positionForm;
        $this->userForm = $userForm;
        $this->adminFilterForm = $adminFilterForm;
        $this->userRepository = $userRepository;
        $this->userCommand = $userCommand;
    }

    public function viewUserListAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $userInfo = [
            [
                'userId'   => 1,
                'isAdmin'  => true,
                'isActive' => true,
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Зубенко Михаил Петрович',
                'position' => 'Уборщик',
                'gender'   => 'Мужской',
                'age'      => 47,
            ],
            [
                'userId'   => 2,
                'isAdmin'  => false,
                'isActive' => true,
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Егоров Владимир Егорович',
                'position' => 'Бухгалтер',
                'gender'   => 'Мужской',
                'age'      => 31,
            ],
            [
                'userId'   => 3,
                'isAdmin'  => true,
                'isActive' => false,
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Мельникова Алёна Вадимовна',
                'position' => 'Юрист',
                'gender'   => 'Женский',
                'age'      => 23,
            ],
            [
                'userId'   => 4,
                'isAdmin'  => false,
                'isActive' => false,
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Тимофеева Вероника Денисовна',
                'position' => 'Менеджер',
                'gender'   => 'Женский',
                'age'      => 36,
            ],
        ];

        $viewModel->setVariables([
            'userInfo'        => $userInfo,
            'maxPageCount'    => self::maxPageCount,
            'page'            => 1,
            'adminFilterForm' => $this->adminFilterForm,
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

        $this->userForm->bind($this->userRepository->findUser($userId));
        $viewModel = new ViewModel(['userForm' => $this->userForm]);

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $viewModel;
        }

        $this->userForm->setData($request->getPost());

        if (!$this->userForm->isValid()) {
            return $viewModel;
        }

        $user = $this->userCommand->updateUser($user);
        return $this->redirect()->toRoute('admin/view-user-list');
    }

    public function editPositionsAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Управление должностями (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $viewModel->setVariable('positionForm', $this->positionForm);

        return $viewModel;
    }
}

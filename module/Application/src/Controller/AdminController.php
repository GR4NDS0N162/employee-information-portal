<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\Entity\Email;
use Application\Model\Entity\Phone;
use Application\Model\Entity\User;
use Application\Model\PhotoUrlGenerator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public const maxPageCount = 20;

    /**
     * @var \Application\Form\Admin\PositionForm
     */
    private $positionForm;

    /**
     * @var \Application\Form\Admin\UserForm
     */
    private $userForm;

    /**
     * @var User
     */
    private $userPrototype;

    public function __construct(
        Form\Admin\PositionForm $positionForm,
        Form\Admin\UserForm     $userForm
    )
    {
        $this->positionForm = $positionForm;
        $this->userForm = $userForm;
        $this->userPrototype = new User(
            4,
            [
                'admin'  => true,
                'active' => false,
            ],
            'Anypassword1.',
            [
                new Email('cfhsoft@verizon.net'),
                new Email('isotopian@att.net'),
                new Email('camenisch@comcast.net'),
                new Email('wetter@mac.com'),
            ],
            [
                new Phone('+79283748264'),
                new Phone('+79365839604'),
                new Phone('+79305847200'),
            ],
            null,
            null,
            'Внуков',
            'Кирилл',
            'Денисович',
            1,
            '2003-05-19',
            '/img/favicon.ico',
            'gr4nds0n162',
        );
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
            'adminFilterForm' => new Form\Admin\AdminFilterForm(),
        ]);

        return $viewModel;
    }

    public function editUserAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование пользователя (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $this->userForm->bind($this->userPrototype);

        $viewModel->setVariables([
            'userForm' => $this->userForm,
        ]);

        return $viewModel;
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

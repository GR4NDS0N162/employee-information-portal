<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\Email;
use Application\Model\Phone;
use Application\Model\PhotoUrlGenerator;
use Application\Model\Profile;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public const maxPageCount = 20;

    /**
     * @var \Application\Form\User\ProfileForm
     */
    private $profileForm;

    /**
     * @var \Application\Form\User\ViewProfileForm
     */
    private $viewProfileForm;

    /**
     * @var Profile
     */
    private $profilePrototype;

    /**
     * @param \Application\Form\User\ProfileForm     $profileForm
     * @param \Application\Form\User\ViewProfileForm $viewProfileForm
     */
    public function __construct($profileForm, $viewProfileForm)
    {
        $this->profileForm = $profileForm;
        $this->viewProfileForm = $viewProfileForm;
        $this->profilePrototype = new Profile(
            null,
            null,
            null,
            null,
            'Внуков',
            'Кирилл',
            'Денисович',
            1,
            '2003-05-19',
            '/img/favicon.ico',
            'gr4nds0n162',
            [
                new Email('1'),
                new Email('2'),
                new Email('3'),
                new Email('4'),
            ],
            [
                new Phone('1'),
                new Phone('2'),
                new Phone('3'),
            ],
        );
    }

    public function viewProfileAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Просмотр профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $this->viewProfileForm->bind($this->profilePrototype);
        $this->viewProfileForm->get('profile')->get('image')->setAttribute('src', $this->profilePrototype->getImage());

        $viewModel->setVariable('viewProfileForm', $this->viewProfileForm);

        return $viewModel;
    }

    public function editProfileAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $this->profileForm->bind($this->profilePrototype);

        $viewModel->setVariables([
            'profileForm'        => $this->profileForm,
            'changePasswordForm' => new Form\User\ChangePasswordForm(),
        ]);

        return $viewModel;
    }

    public function viewUserListAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $userInfo = [
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Зубенко Михаил Петрович',
                'position' => 'Уборщик',
                'gender'   => 'Мужской',
                'age'      => 47,
            ],
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Егоров Владимир Егорович',
                'position' => 'Бухгалтер',
                'gender'   => 'Мужской',
                'age'      => 31,
            ],
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Мельникова Алёна Вадимовна',
                'position' => 'Юрист',
                'gender'   => 'Женский',
                'age'      => 23,
            ],
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Тимофеева Вероника Денисовна',
                'position' => 'Менеджер',
                'gender'   => 'Женский',
                'age'      => 36,
            ],
        ];

        $viewModel->setVariables([
            'userInfo'       => $userInfo,
            'maxPageCount'   => self::maxPageCount,
            'page'           => 1,
            'userFilterForm' => new Form\User\UserFilterForm(),
        ]);

        return $viewModel;
    }
}

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
    /**
     * @var Form\ProfileForm
     */
    private $profileForm;

    /**
     * @var Form\ViewProfileForm
     */
    private $viewProfileForm;

    /**
     * @var Profile
     */
    private $profilePrototype;

    /**
     * @param Form\ProfileForm     $profileForm
     * @param Form\ViewProfileForm $viewProfileForm
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
            null,
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
            'editProfileForm'    => new Form\EditProfileForm(),
            'changePasswordForm' => new Form\ChangePasswordForm(),
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

        $viewModel->setVariable('userInfo', $userInfo);
        $viewModel->setVariable('userFilterForm', new Form\UserFilterForm());

        return $viewModel;
    }
}

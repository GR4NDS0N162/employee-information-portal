<?php

namespace Application\Controller;

use Application\Form;
use Application\Form\User\ChangePasswordForm;
use Application\Form\User\ProfileForm;
use Application\Form\User\UserFilterForm;
use Application\Form\User\ViewProfileForm;
use Application\Model\Entity\Email;
use Application\Model\Entity\Phone;
use Application\Model\Entity\Profile;
use Application\Model\PhotoUrlGenerator;
use Application\Model\UserRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public const maxPageCount = 20;

    /**
     * @var ProfileForm
     */
    private $profileForm;

    /**
     * @var ViewProfileForm
     */
    private $viewProfileForm;

    /**
     * @var UserFilterForm
     */
    private $userFilterForm;

    /**
     * @var Profile
     */
    private $profilePrototype;

    /**
     * @var ChangePasswordForm
     */
    private $changePasswordForm;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        ProfileForm             $profileForm,
        ViewProfileForm         $viewProfileForm,
        UserFilterForm          $userFilterForm,
        ChangePasswordForm      $changePasswordForm,
        UserRepositoryInterface $userRepository
    ) {
        $this->profileForm = $profileForm;
        $this->viewProfileForm = $viewProfileForm;
        $this->userFilterForm = $userFilterForm;
        $this->changePasswordForm = $changePasswordForm;
        $this->userRepository = $userRepository;
        $this->profilePrototype = new Profile(
            '',
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
            'changePasswordForm' => $this->changePasswordForm,
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
            'userFilterForm' => $this->userFilterForm,
        ]);

        return $viewModel;
    }
}

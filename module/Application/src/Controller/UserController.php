<?php

namespace Application\Controller;

use Application\Form;
use Application\Form\User\ChangePasswordForm;
use Application\Form\User\ProfileForm;
use Application\Form\User\UserFilterForm;
use Application\Form\User\ViewProfileForm;
use Application\Model\PhotoUrlGenerator;
use Application\Model\UserCommandInterface;
use Application\Model\UserRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public const maxPageCount = 20;
    public const userId = 1;

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
     * @var ChangePasswordForm
     */
    private $changePasswordForm;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserCommandInterface
     */
    private $userCommand;

    public function __construct(
        ProfileForm             $profileForm,
        ViewProfileForm         $viewProfileForm,
        UserFilterForm          $userFilterForm,
        ChangePasswordForm      $changePasswordForm,
        UserRepositoryInterface $userRepository,
        UserCommandInterface    $userCommand
    ) {
        $this->profileForm = $profileForm;
        $this->viewProfileForm = $viewProfileForm;
        $this->userFilterForm = $userFilterForm;
        $this->changePasswordForm = $changePasswordForm;
        $this->userRepository = $userRepository;
        $this->userCommand = $userCommand;
    }

    public function viewProfileAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Просмотр профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $user = $this->userRepository->findUser(self::userId);
        $this->viewProfileForm->bind($user);
        $this->viewProfileForm->get('profile')->get('image')->setAttribute('src', $user->getImage());

        $viewModel->setVariable('viewProfileForm', $this->viewProfileForm);

        return $viewModel;
    }

    public function editProfileAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $user = $this->userRepository->findUser(self::userId);
        $this->profileForm->bind($user);
        $this->changePasswordForm->bind($user);

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

<?php

namespace Application\Controller;

use Application\Form\User as Form;
use Application\Model\Command\UserCommandInterface;
use Application\Model\PhotoUrlGenerator;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public const maxPageCount = 20;
    public const userId = 1;

    /**
     * @var Form\ProfileForm
     */
    private $profileForm;
    /**
     * @var Form\ViewProfileForm
     */
    private $viewProfileForm;
    /**
     * @var Form\UserFilterForm
     */
    private $userFilterForm;
    /**
     * @var Form\ChangePasswordForm
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

    /**
     * @param Form\ProfileForm        $profileForm
     * @param Form\ViewProfileForm    $viewProfileForm
     * @param Form\UserFilterForm     $userFilterForm
     * @param Form\ChangePasswordForm $changePasswordForm
     * @param UserRepositoryInterface $userRepository
     * @param UserCommandInterface    $userCommand
     */
    public function __construct(
        $profileForm,
        $viewProfileForm,
        $userFilterForm,
        $changePasswordForm,
        $userRepository,
        $userCommand
    ) {
        $this->profileForm = $profileForm;
        $this->viewProfileForm = $viewProfileForm;
        $this->userFilterForm = $userFilterForm;
        $this->changePasswordForm = $changePasswordForm;
        $this->userRepository = $userRepository;
        $this->userCommand = $userCommand;
    }

    public function viewProfileAction()
    {
        $viewModel = new ViewModel([
            'viewProfileForm' => $this->viewProfileForm,
        ]);

        $this->layout()->setVariables([
            'headTitleName' => 'Просмотр профиля',
        ]);

        $user = $this->userRepository->findUser(self::userId);
        $this->viewProfileForm->bind($user);
        $this->viewProfileForm->get('profile')->get('image')->setAttribute('src', $user->getImage());

        return $viewModel;
    }

    public function editProfileAction()
    {
        try {
            $foundUser = $this->userRepository->findUser(self::userId);
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('home');
        }

        $viewModel = new ViewModel([
            'profileForm'        => $this->profileForm,
            'changePasswordForm' => $this->changePasswordForm,
        ]);

        $this->layout()->setVariables([
            'headTitleName' => 'Редактирование профиля',
            'navbar'        => 'Laminas\Navigation\Admin',
        ]);

        $this->profileForm->bind($foundUser);
        $this->changePasswordForm->bind($foundUser);

        return $viewModel;
    }

    public function profileFormAction()
    {
    }

    public function changePasswordFormAction()
    {
    }

    public function viewUserListAction()
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
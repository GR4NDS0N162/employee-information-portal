<?php

namespace Application\Controller;

use Application\Form\User as Form;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\ChangePassword;
use Application\Model\Repository\StatusRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container as SessionContainer;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    /** @var int Maximum number of users displayed on a page. */
    public const MAX_USER_COUNT = 20;
    /** @var int The ID of the user who is currently logged in to the system. */
    public const USER_ID = 1;

    private Form\ProfileForm $profileForm;
    private Form\ViewProfileForm $viewProfileForm;
    private Form\UserFilterForm $userFilterForm;
    private Form\ChangePasswordForm $changePasswordForm;
    private UserRepositoryInterface $userRepository;
    private UserCommandInterface $userCommand;
    private SessionContainer $sessionContainer;
    private StatusRepositoryInterface $statusRepository;

    public function __construct(
        Form\ProfileForm          $profileForm,
        Form\ViewProfileForm      $viewProfileForm,
        Form\UserFilterForm       $userFilterForm,
        Form\ChangePasswordForm   $changePasswordForm,
        UserRepositoryInterface   $userRepository,
        StatusRepositoryInterface $statusRepository,
        UserCommandInterface      $userCommand,
        SessionContainer          $sessionContainer
    ) {
        $this->profileForm = $profileForm;
        $this->viewProfileForm = $viewProfileForm;
        $this->userFilterForm = $userFilterForm;
        $this->changePasswordForm = $changePasswordForm;
        $this->userRepository = $userRepository;
        $this->statusRepository = $statusRepository;
        $this->userCommand = $userCommand;
        $this->sessionContainer = $sessionContainer;
    }

    public function viewProfileAction()
    {
        $userId = $this->sessionContainer->offsetGet(LoginController::USER_ID);
        if (!is_integer($userId)) {
            return $this->redirect()->toRoute('home');
        }

        UserController::setAdminNavbar($this->statusRepository, $this, $userId);

        $this->layout()->setVariables(['headTitleName' => 'View profile']);
        $viewModel = new ViewModel(['viewProfileForm' => $this->viewProfileForm]);

        $profile = $this->userRepository->findProfile($userId);
        $this->viewProfileForm->bind($profile);
        $this->viewProfileForm->get('profile')->get('image')
            ->setAttribute('src', $profile->getImagePath());

        return $viewModel;
    }

    public static function setAdminNavbar(
        StatusRepositoryInterface $statusRepository,
        AbstractActionController  $controller,
        int                       $userId
    ) {
        if ($statusRepository->checkStatusOfUser($userId, 'admin')) {
            $controller->layout()->setVariables(['navbar' => 'Laminas\Navigation\Admin']);
        }
    }

    public function editProfileAction()
    {
        UserController::setAdminNavbar($this->statusRepository, $this, self::USER_ID);
        $this->layout()->setVariables(['headTitleName' => 'Edit profile']);

        try {
            $foundProfile = $this->userRepository->findProfile(self::USER_ID);
            $changePassword = new ChangePassword($foundProfile->getId());
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('home');
        }

        $viewModel = new ViewModel([
            'profileForm'        => $this->profileForm,
            'changePasswordForm' => $this->changePasswordForm,
        ]);

        $this->profileForm->bind($foundProfile);
        $this->changePasswordForm->bind($changePassword);

        return $viewModel;
    }

    public function profileFormAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('user/edit-profile');
        }

        $postData = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );

        $this->profileForm->setData($postData);

        if (!$this->profileForm->isValid()) {
            return $this->redirect()->toRoute('user/edit-profile');
        }

        $this->userCommand->updateProfile($this->profileForm->getObject());

        return $this->redirect()->toRoute('user/view-profile');
    }

    public function changePasswordFormAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('user/edit-profile');
        }

        $this->changePasswordForm->setData($request->getPost());

        if (!$this->changePasswordForm->isValid()) {
            return $this->redirect()->toRoute('user/edit-profile');
        }

        $this->userCommand->changePassword(
            $this->changePasswordForm->getObject()
        );

        return $this->redirect()->toRoute('user/edit-profile');
    }

    public function viewUserListAction()
    {
        UserController::setAdminNavbar($this->statusRepository, $this, self::USER_ID);
        $viewModel = new ViewModel();

        $headTitleName = 'List of users';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariables([
            'userFilterForm' => $this->userFilterForm,
        ]);

        return $viewModel;
    }
}
<?php

namespace Application\Controller;

use Application\Form\Login;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container as SessionContainer;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    /** @var string The key that stores the id of the logged-in user. */
    const USER_ID = 'userId';

    private Login\LoginForm $loginForm;
    private Login\SignUpForm $signUpForm;
    private Login\RecoverForm $recoverForm;
    private UserCommandInterface $userCommand;
    private UserRepositoryInterface $userRepository;
    private SessionContainer $sessionContainer;

    public function __construct(
        Login\LoginForm         $loginForm,
        Login\SignUpForm        $signUpForm,
        Login\RecoverForm       $recoverForm,
        UserCommandInterface    $userCommand,
        UserRepositoryInterface $userRepository,
        SessionContainer        $sessionContainer
    ) {
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
        $this->userCommand = $userCommand;
        $this->userRepository = $userRepository;
        $this->sessionContainer = $sessionContainer;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel([
            'loginForm'   => $this->loginForm,
            'signUpForm'  => $this->signUpForm,
            'recoverForm' => $this->recoverForm,
        ]);

        $this->layout('layout/home-layout');
        $this->layout()->setVariable('headTitleName', 'Login | Sign up');

        return $viewModel;
    }

    public function loginAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('home');
        }

        $this->loginForm->setData($request->getPost());

        if (!$this->loginForm->isValid()) {
            return $this->redirect()->toRoute('home');
        }

        $data = $this->loginForm->getData();

        $email = new Email($data['email']);
        $password = $data['currentPassword'];

        try {
            $foundUser = $this->userRepository->findUser($email);
        } catch (InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('home');
        }

        if ($foundUser->getPassword() == $password) {
            $this->sessionContainer->offsetSet(self::USER_ID, $foundUser->getId());
            return $this->redirect()->toRoute('user/view-profile');
        } else {
            return $this->redirect()->toRoute('home');
        }
    }

    public function signUpAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('home');
        }

        $this->signUpForm->setData($request->getPost());

        if (!$this->signUpForm->isValid()) {
            return $this->redirect()->toRoute('home');
        }

        $data = $this->signUpForm->getData();

        $email = new Email($data['email']);
        $user = new User(
            $data['newPassword'],
            $data['positionId'],
        );

        $this->userCommand->insertUser($user, $email);
        return $this->redirect()->toRoute('user/view-profile');
    }

    public function recoverAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('home');
        }

        $this->recoverForm->setData($request->getPost());

        if (!$this->recoverForm->isValid()) {
            return $this->redirect()->toRoute('home');
        }

        $data = $this->recoverForm->getData();
        $email = new Email($data['email']);

        $this->userCommand->setTempPassword($email);
        return $this->redirect()->toRoute('home');
    }
}

<?php

namespace Application\Controller;

use Application\Form\Login;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    private Login\LoginForm $loginForm;
    private Login\SignUpForm $signUpForm;
    private Login\RecoverForm $recoverForm;
    private UserCommandInterface $userCommand;

    public function __construct(
        Login\LoginForm      $loginForm,
        Login\SignUpForm     $signUpForm,
        Login\RecoverForm    $recoverForm,
        UserCommandInterface $userCommand
    ) {
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
        $this->userCommand = $userCommand;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel([
            'loginForm'   => $this->loginForm,
            'signUpForm'  => $this->signUpForm,
            'recoverForm' => $this->recoverForm,
        ]);

        $this->layout('layout/home-layout');
        $this->layout()->setVariable('headTitleName', 'Вход | Регистрация');

        return $viewModel;
    }

    public function loginAction()
    {
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

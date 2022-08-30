<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Exception;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    private $loginForm;
    private $signUpForm;
    private $recoverForm;
    private $userCommand;

    public function __construct(
        $loginForm,
        $signUpForm,
        $recoverForm,
        $userCommand
    ) {
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
        $this->userCommand = $userCommand;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel();

        $this->layout('layout/home-layout');

        $headTitleName = 'Вход | Регистрация';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariables([
            'loginForm'   => $this->loginForm,
            'signUpForm'  => $this->signUpForm,
            'recoverForm' => $this->recoverForm,
        ]);

        return $viewModel;
    }

    public function loginAction()
    {
    }

    public function signUpAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost())
            return $this->redirect()->toRoute('home');

        $this->signUpForm->setData($request->getPost());

        if (!$this->signUpForm->isValid())
            return $this->redirect()->toRoute('home');

        $data = $this->signUpForm->getData();

        $email = new Email($data['email']);
        $user = new User();
        $user->setPositionId($data['position']);
        $user->setPassword($data['new-password']);

        try {
            $this->userCommand->insertUser($user, $email);
        } catch (Exception $ex) {
            throw $ex;
        }

        return $this->redirect()->toRoute('user\view-profile');
    }

    public function recoverAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost())
            return $this->redirect()->toRoute('home');

        $this->recoverForm->setData($request->getPost());

        if (!$this->recoverForm->isValid())
            return $this->redirect()->toRoute('home');

        $data = $this->recoverForm->getData();
        $email = new Email($data['email']);

        try {
            $this->userCommand->setTempPassword($email);
        } catch (Exception $ex) {
            throw $ex;
        }

        return $this->redirect()->toRoute('home');
    }
}

<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\UserCommandInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    /**
     * @var Form\Login\LoginForm
     */
    private $loginForm;

    /**
     * @var Form\Login\SignUpForm
     */
    private $signUpForm;

    /**
     * @var Form\Login\RecoverForm
     */
    private $recoverForm;

    /**
     * @var UserCommandInterface
     */
    private $userCommand;

    public function __construct(
        Form\Login\LoginForm   $loginForm,
        Form\Login\SignUpForm  $signUpForm,
        Form\Login\RecoverForm $recoverForm,
        UserCommandInterface   $userCommand
    ) {
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
        $this->userCommand = $userCommand;
    }

    public function indexAction(): ViewModel
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
    }

    public function recoverAction()
    {
    }
}

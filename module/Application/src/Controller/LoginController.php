<?php

namespace Application\Controller;

use Application\Form;
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

    public function __construct(
        Form\Login\LoginForm   $loginForm,
        Form\Login\SignUpForm  $signUpForm,
        Form\Login\RecoverForm $recoverForm
    ) {
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
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

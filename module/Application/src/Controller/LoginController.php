<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\LoginForm;
use Application\Form\RecoverForm;
use Application\Form\SignUpForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
        $viewModel = new ViewModel();

        $this->layout('layout/home-layout');

        $headTitleName = 'Вход | Регистрация';

        $this->layout()->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        $loginForm = new LoginForm();
        $signUpForm = new SignUpForm();
        $recoverForm = new RecoverForm();

        $viewModel->setVariables([
            'loginForm' => $loginForm,
            'signUpForm' => $signUpForm,
            'recoverForm' => $recoverForm,
        ]);

        return $viewModel;
    }
}
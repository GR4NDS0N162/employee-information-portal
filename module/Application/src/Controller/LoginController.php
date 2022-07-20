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

        $loginForm = new LoginForm();
        $signupForm = new SignUpForm();
        $recoverForm = new RecoverForm();

        $headTitleName = 'Вход | Регистрация';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
            'loginForm'     => $loginForm,
            'signupForm'    => $signupForm,
            'recoverForm'   => $recoverForm,
        ]);

        return $viewModel;
    }
}

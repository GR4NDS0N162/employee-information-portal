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

        $loginViewModel = new ViewModel();
        $loginViewModel->setVariables([
            'loginForm' => $loginForm,
        ]);
        $loginViewModel->setTemplate('content/login/view');

        $signupViewModel = new ViewModel();
        $signupViewModel->setVariables([
            'signupForm' => $signupForm,
        ]);
        $signupViewModel->setTemplate('content/signup/view');

        $recoverViewModel = new ViewModel();
        $recoverViewModel->setVariables([
            'recoverForm' => $recoverForm,
        ]);
        $recoverViewModel->setTemplate('content/recover/view');

        $viewModel
            ->addChild($loginViewModel, 'login')
            ->addChild($signupViewModel, 'signup')
            ->addChild($recoverViewModel, 'recover');

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }
}

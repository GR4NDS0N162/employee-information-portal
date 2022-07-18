<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\LoginForm;
use Application\Form\SignUpForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
        $loginForm = new LoginForm();
        $signupForm = new SignUpForm();

        return new ViewModel([
            'loginForm' => $loginForm,
            'signupForm' => $signupForm,
        ]);
    }

    public function processAction()
    {
        return new ViewModel();
    }
}

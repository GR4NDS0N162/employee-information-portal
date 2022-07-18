<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\LoginForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
        $loginForm = new LoginForm();

        return new ViewModel([
            'loginForm' => $loginForm,
        ]);
    }

    public function processAction()
    {
        return new ViewModel();
    }
}

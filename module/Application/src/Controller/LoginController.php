<?php

namespace Application\Controller;

use Application\Form;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    public function loginAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $this->layout('layout/home-layout');

        $headTitleName = 'Вход | Регистрация';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariables([
            'loginForm'   => new Form\Login\LoginForm(),
            'signUpForm'  => new Form\Login\SignUpForm(),
            'recoverForm' => new Form\Login\RecoverForm(),
        ]);

        return $viewModel;
    }
}

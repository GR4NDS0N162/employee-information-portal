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
            'loginForm'   => new Form\LoginForm(),
            'signUpForm'  => new Form\SignUpForm(),
            'recoverForm' => new Form\RecoverForm(),
        ]);

        return $viewModel;
    }
}

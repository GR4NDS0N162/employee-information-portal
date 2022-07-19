<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\UserForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function listAction()
    {
        $userForm = new UserForm();

        $view = new ViewModel([
            'userForm' => $userForm,
        ]);

        return $view;
    }
}

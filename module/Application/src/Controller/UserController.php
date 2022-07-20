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
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }
}

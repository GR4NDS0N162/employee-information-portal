<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\AdminForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public function listAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей (Администратор)';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }

    public function editAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование пользователя (Администратор)';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }
}

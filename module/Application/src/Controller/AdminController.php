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

        return $viewModel;
    }

    public function editAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }
}

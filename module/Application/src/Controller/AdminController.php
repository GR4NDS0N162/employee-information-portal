<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function editUserAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function editPositionsAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }
}

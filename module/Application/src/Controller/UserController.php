<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function viewProfileAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function editProfileAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function viewDialogListAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function viewMessagesAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }
}

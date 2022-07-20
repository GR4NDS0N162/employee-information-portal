<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\DialogForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class MessengerController extends AbstractActionController
{
    public function dialogsAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    public function messagesAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }
}

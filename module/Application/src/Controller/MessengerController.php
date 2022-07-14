<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class MessengerController extends AbstractActionController
{
    public function dialogsAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function messagesAction()
    {
        $view = new ViewModel();
        return $view;
    }
}

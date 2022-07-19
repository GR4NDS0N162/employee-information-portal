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
        $dialogForm = new DialogForm();

        $view = new ViewModel([
            'dialogForm' => $dialogForm,
        ]);

        return $view;
    }

    public function messagesAction()
    {
        $view = new ViewModel();
        return $view;
    }
}

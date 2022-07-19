<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\ListForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function listAction()
    {
        $listForm = new ListForm();

        $view = new ViewModel([
            'listForm' => $listForm,
        ]);

        return $view;
    }
}

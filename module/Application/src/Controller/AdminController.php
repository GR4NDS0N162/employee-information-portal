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
        $adminForm = new AdminForm();

        $view = new ViewModel([
            'adminForm' => $adminForm,
        ]);

        return $view;
    }

    public function editAction()
    {
        $view = new ViewModel();
        return $view;
    }
}

<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProfileController extends AbstractActionController
{
    public function viewAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function editAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function processAction()
    {
        return new ViewModel();
    }
}

<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PositionController extends AbstractActionController
{
    public function editAction()
    {
        $view = new ViewModel();
        return $view;
    }
}

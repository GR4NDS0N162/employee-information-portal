<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PositionController extends AbstractActionController
{
    public function editAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Управление должностями (Администратор)';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }
}

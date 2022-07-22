<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\PositionForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей (Администратор)';

        $this->layout()->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }

    public function editUserAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование пользователя (Администратор)';

        $this->layout()->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }

    public function editPositionsAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Управление должностями (Администратор)';

        $this->layout()->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        $positionForm = new PositionForm();

        $viewModel->setVariables([
            'positionForm'=>$positionForm,
        ]);

        return $viewModel;
    }
}

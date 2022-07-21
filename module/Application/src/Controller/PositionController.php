<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Position;
use Application\Form\PositionForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PositionController extends AbstractActionController
{
    public function editAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Управление должностями (Администратор)';

        $positionForm = new PositionForm();
        $position = new Position();
        $positionForm->bind($position);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $positionForm->setData($request->getPost());

            if ($positionForm->isValid()) {
                var_dump($position);
            }
        }

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
            'positionForm'  => $positionForm,
        ]);

        return $viewModel;
    }
}

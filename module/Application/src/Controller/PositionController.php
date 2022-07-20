<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Entity\Position;
use Application\Form\EditPositionForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PositionController extends AbstractActionController
{
    public function editAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Управление должностями (Администратор)';

        $editPositionForm = new EditPositionForm();
        $product = new Position();
        $editPositionForm->bind($product);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $editPositionForm->setData($request->getPost());

            if ($editPositionForm->isValid()) {
                var_dump($product);
            }
        }

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
            'editPositionForm' => $editPositionForm,
        ]);

        return $viewModel;
    }
}

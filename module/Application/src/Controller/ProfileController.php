<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\PasswordForm;
use Application\Form\ProfileForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProfileController extends AbstractActionController
{
    public function viewAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Просмотр профиля';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }

    public function editAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование профиля';

        $viewModel->setVariables([
            'headTitleName' => $headTitleName,
        ]);

        return $viewModel;
    }
}

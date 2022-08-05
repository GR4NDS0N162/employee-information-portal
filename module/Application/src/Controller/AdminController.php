<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }

    public function editUserAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование пользователя (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariables([
            'editUserForm' => new Form\EditUserForm(),
            'changePasswordForm' => new Form\ChangePasswordForm(),
            'editPhoneForm' => new Form\EditPhoneForm(),
            'editEmailForm' => new Form\EditEmailForm(),
        ]);

        return $viewModel;
    }

    public function editPositionsAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Управление должностями (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }
}

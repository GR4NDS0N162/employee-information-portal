<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function viewProfileAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Просмотр профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }

    public function editProfileAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }

    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }

    public function viewDialogListAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Диалоги';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }

    public function viewMessagesAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Сообщения';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        return $viewModel;
    }
}

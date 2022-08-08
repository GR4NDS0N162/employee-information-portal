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
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $user_info = [
            [
                'userId' => 1,
                'isAdmin' => true,
                'isActive' => true,
                'photo' => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Зубенко Михаил Петрович',
                'position' => 'Уборщик',
                'gender' => 'Мужской',
                'age' => 47,
            ],
            [
                'userId' => 2,
                'isAdmin' => false,
                'isActive' => true,
                'photo' => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Егоров Владимир Егорович',
                'position' => 'Бухгалтер',
                'gender' => 'Мужской',
                'age' => 31,
            ],
            [
                'userId' => 3,
                'isAdmin' => true,
                'isActive' => false,
                'photo' => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Мельникова Алёна Вадимовна',
                'position' => 'Юрист',
                'gender' => 'Женский',
                'age' => 23,
            ],
            [
                'userId' => 4,
                'isAdmin' => false,
                'isActive' => false,
                'photo' => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Тимофеева Вероника Денисовна',
                'position' => 'Менеджер',
                'gender' => 'Женский',
                'age' => 36,
            ],
        ];

        $viewModel->setVariable('user_info', $user_info);
        $viewModel->setVariable('adminFilterForm', new Form\AdminFilterForm());

        return $viewModel;
    }

    public function editUserAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование пользователя (Администратор)';

        $this->layout()->setVariable('headTitleName', $headTitleName);
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

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
        $this->layout()->setVariable('navbar', 'Laminas\Navigation\Admin');

        $viewModel->setVariable('editPositionForm', new Form\EditPositionForm());

        return $viewModel;
    }
}

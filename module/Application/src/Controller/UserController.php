<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\PhotoUrlGenerator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function viewProfileAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Просмотр профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $userInfo = [
            'photo'      => PhotoUrlGenerator::generate(),
            'surname'    => 'Зубенко',
            'name'       => 'Михаил',
            'patronymic' => 'Петрович',
            'gender'     => 'Мужской',
            'birthday'   => '16.10.1968',
            'skype'      => 'ivanivanov',
            'phones'     => [
                ['value' => '+79283639473'],
                ['value' => '+79462846274'],
                ['value' => '+79204764782'],
                ['value' => '+79347296067'],
            ],
            'emails'     => [
                ['value' => 'name@example.com'],
                ['value' => 'name@example.com'],
                ['value' => 'name@example.com'],
                ['value' => 'name@example.com'],
            ],
        ];

        $viewModel->setVariable('userInfo', $userInfo);

        return $viewModel;
    }

    public function editProfileAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Редактирование профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariables([
            'editProfileForm'    => new Form\EditProfileForm(),
            'changePasswordForm' => new Form\ChangePasswordForm(),
            'editPhoneForm'      => new Form\EditPhoneForm(),
            'editEmailForm'      => new Form\EditEmailForm(),
        ]);

        return $viewModel;
    }

    public function viewUserListAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $userInfo = [
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Зубенко Михаил Петрович',
                'position' => 'Уборщик',
                'gender'   => 'Мужской',
                'age'      => 47,
            ],
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Егоров Владимир Егорович',
                'position' => 'Бухгалтер',
                'gender'   => 'Мужской',
                'age'      => 31,
            ],
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Мельникова Алёна Вадимовна',
                'position' => 'Юрист',
                'gender'   => 'Женский',
                'age'      => 23,
            ],
            [
                'photo'    => PhotoUrlGenerator::generate(),
                'fullname' => 'Тимофеева Вероника Денисовна',
                'position' => 'Менеджер',
                'gender'   => 'Женский',
                'age'      => 36,
            ],
        ];

        $viewModel->setVariable('userInfo', $userInfo);
        $viewModel->setVariable('userFilterForm', new Form\UserFilterForm());

        return $viewModel;
    }
}

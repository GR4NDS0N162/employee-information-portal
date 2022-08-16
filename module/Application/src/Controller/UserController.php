<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function viewProfileAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Просмотр профиля';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $userInfo = [
            'photo'      => 'https://picsum.photos/900',
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

    public function editProfileAction()
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

    public function viewUserListAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Список пользователей';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $userInfo = [
            [
                'photo'    => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Зубенко Михаил Петрович',
                'position' => 'Уборщик',
                'gender'   => 'Мужской',
                'age'      => 47,
            ],
            [
                'photo'    => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Егоров Владимир Егорович',
                'position' => 'Бухгалтер',
                'gender'   => 'Мужской',
                'age'      => 31,
            ],
            [
                'photo'    => 'https://picsum.photos/' . random_int(100, 999),
                'fullname' => 'Мельникова Алёна Вадимовна',
                'position' => 'Юрист',
                'gender'   => 'Женский',
                'age'      => 23,
            ],
            [
                'photo'    => 'https://picsum.photos/' . random_int(100, 999),
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

    public function viewDialogListAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Диалоги';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $dialogs = [
            [
                'userId'    => 1,
                'hasDialog' => true,
                'photo'     => 'https://picsum.photos/' . random_int(100, 999),
                'fullname'  => 'Зубенко Михаил Петрович',
                'position'  => 'Уборщик',
                'gender'    => 'Мужской',
                'age'       => 47,
            ],
            [
                'userId'    => 2,
                'hasDialog' => true,
                'photo'     => 'https://picsum.photos/' . random_int(100, 999),
                'fullname'  => 'Егоров Владимир Егорович',
                'position'  => 'Бухгалтер',
                'gender'    => 'Мужской',
                'age'       => 31,
            ],
            [
                'userId'    => 3,
                'hasDialog' => false,
                'photo'     => 'https://picsum.photos/' . random_int(100, 999),
                'fullname'  => 'Мельникова Алёна Вадимовна',
                'position'  => 'Юрист',
                'gender'    => 'Женский',
                'age'       => 23,
            ],
            [
                'userId'    => 4,
                'hasDialog' => false,
                'photo'     => 'https://picsum.photos/' . random_int(100, 999),
                'fullname'  => 'Тимофеева Вероника Денисовна',
                'position'  => 'Менеджер',
                'gender'    => 'Женский',
                'age'       => 36,
            ],
        ];

        $viewModel->setVariable('dialogs', $dialogs);
        $viewModel->setVariable('dialogFilterForm', new Form\DialogFilterForm());

        return $viewModel;
    }

    public function viewMessagesAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Сообщения';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariable('newMessageForm', new Form\NewMessageForm());

        $userInfo = [
            'fullname' => 'Иван Иванов',
            'photo'    => 'https://picsum.photos/' . random_int(100, 999),
        ];

        $buddyInfo = [
            'fullname' => 'Петя Петров',
            'photo'    => 'https://picsum.photos/' . random_int(100, 999),
        ];

        $messages = [
            [
                'isUserSender' => true,
                'content'      => 'Привет1',
                'createdAt'    => '16.05.2022 16:32',
                'openedAt'     => '16.05.2022 16:34',
            ],
            [
                'isUserSender' => true,
                'content'      => 'Привет2',
                'createdAt'    => '16.05.2022 16:36',
                'openedAt'     => '16.05.2022 16:37',
            ],
            [
                'isUserSender' => false,
                'content'      => 'Привет3',
                'createdAt'    => '16.05.2022 16:38',
                'openedAt'     => '16.05.2022 16:39',
            ],
            [
                'isUserSender' => true,
                'content'      => 'Привет4',
                'createdAt'    => '16.05.2022 16:40',
            ],
            [
                'isUserSender' => false,
                'content'      => 'Привет5',
                'createdAt'    => '16.05.2022 16:42',
            ],
        ];

        $viewModel->setVariables([
            'messages'  => $messages,
            'userInfo'  => $userInfo,
            'buddyInfo' => $buddyInfo,
        ]);

        return $viewModel;
    }
}

<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\PhotoUrlGenerator;
use Application\Model\Repository\DialogRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class MessengerController extends AbstractActionController
{
    private $dialogFilterForm;
    private $newMessageForm;
    /**
     * @var DialogRepositoryInterface
     */
    private $dialogRepository;

    public function __construct($dialogFilterForm, $newMessageForm, $dialogRepository)
    {
        $this->dialogFilterForm = $dialogFilterForm;
        $this->newMessageForm = $newMessageForm;
        $this->dialogRepository = $dialogRepository;
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
                'photo'     => PhotoUrlGenerator::generate(),
                'fullname'  => 'Зубенко Михаил Петрович',
                'position'  => 'Уборщик',
                'gender'    => 'Мужской',
                'age'       => 47,
            ],
            [
                'userId'    => 2,
                'hasDialog' => true,
                'photo'     => PhotoUrlGenerator::generate(),
                'fullname'  => 'Егоров Владимир Егорович',
                'position'  => 'Бухгалтер',
                'gender'    => 'Мужской',
                'age'       => 31,
            ],
            [
                'userId'    => 3,
                'hasDialog' => false,
                'photo'     => PhotoUrlGenerator::generate(),
                'fullname'  => 'Мельникова Алёна Вадимовна',
                'position'  => 'Юрист',
                'gender'    => 'Женский',
                'age'       => 23,
            ],
            [
                'userId'    => 4,
                'hasDialog' => false,
                'photo'     => PhotoUrlGenerator::generate(),
                'fullname'  => 'Тимофеева Вероника Денисовна',
                'position'  => 'Менеджер',
                'gender'    => 'Женский',
                'age'       => 36,
            ],
        ];

        $viewModel->setVariable('dialogs', $dialogs);
        $viewModel->setVariable('dialogFilterForm', $this->dialogFilterForm);

        return $viewModel;
    }

    public function viewMessagesAction()
    {
        $viewModel = new ViewModel();

        $headTitleName = 'Сообщения';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariable('newMessageForm', $this->newMessageForm);

        $userInfo = [
            'fullname' => 'Иван Иванов',
            'photo'    => PhotoUrlGenerator::generate(),
        ];

        $buddyInfo = [
            'fullname' => 'Петя Петров',
            'photo'    => PhotoUrlGenerator::generate(),
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

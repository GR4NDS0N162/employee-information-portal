<?php

namespace Application\Controller;

use Application\Form\Messenger\DialogFilterForm;
use Application\Form\Messenger\NewMessageForm;
use Application\Model\Command\MessageCommandInterface;
use Application\Model\Entity\Message;
use Application\Model\Repository\DialogRepositoryInterface;
use Application\Model\Repository\MessageRepositoryInterface;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container as SessionContainer;
use Laminas\View\Model\ViewModel;

class MessengerController extends AbstractActionController
{
    /** @var int Maximum number of uploaded messages at a time. */
    public const MAX_MESSAGE_COUNT = 20;

    private DialogFilterForm $dialogFilterForm;
    private NewMessageForm $newMessageForm;
    private DialogRepositoryInterface $dialogRepository;
    private UserRepositoryInterface $userRepository;
    private PositionRepositoryInterface $positionRepository;
    private MessageRepositoryInterface $messageRepository;
    private MessageCommandInterface $messageCommand;
    private SessionContainer $sessionContainer;

    public function __construct(
        DialogFilterForm            $dialogFilterForm,
        NewMessageForm              $newMessageForm,
        DialogRepositoryInterface   $dialogRepository,
        UserRepositoryInterface     $userRepository,
        PositionRepositoryInterface $positionRepository,
        MessageRepositoryInterface  $messageRepository,
        MessageCommandInterface     $messageCommand,
        SessionContainer            $sessionContainer
    ) {
        $this->dialogFilterForm = $dialogFilterForm;
        $this->newMessageForm = $newMessageForm;
        $this->dialogRepository = $dialogRepository;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->messageRepository = $messageRepository;
        $this->messageCommand = $messageCommand;
        $this->sessionContainer = $sessionContainer;
    }

    public function viewDialogListAction()
    {
        $userId = $this->getUserId();

        UserController::setAdminNavbar($this->userRepository, $this, $userId);

        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Диалоги');

        $dialogs = $this->dialogRepository->getDialogList($userId);

        $viewModel->setVariables([
            'dialogs'            => $dialogs,
            'dialogFilterForm'   => $this->dialogFilterForm,
            'userRepository'     => $this->userRepository,
            'positionRepository' => $this->positionRepository,
        ]);

        return $viewModel;
    }

    public function viewMessagesAction()
    {
        $userId = $this->getUserId();

        UserController::setAdminNavbar($this->userRepository, $this, $userId);

        $buddyId = (int)$this->params()->fromRoute('id', 0);

        if (
            $buddyId === 0 ||
            $buddyId === $userId
        ) {
            return $this->redirect()->toRoute('user/view-dialog-list');
        }

        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Сообщения');

        $userInfo = $this->userRepository->findUser($userId);
        $buddyInfo = $this->userRepository->findUser($buddyId);

        $viewModel->setVariables([
            'newMessageForm' => $this->newMessageForm,
            'userInfo'       => $userInfo,
            'buddyInfo'      => $buddyInfo,
        ]);

        return $viewModel;
    }

    public function getDialogsAction()
    {
        $userId = $this->getUserId();

        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $data = AdminController::arrayFilterRecursive($request->getPost()->toArray());

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('partial/dialog-list.phtml');

        $viewModel->setVariables([
            'dialogList'     => $this->dialogRepository->getDialogList(
                $userId,
                AdminController::getWhere($data)
            ),
            'userRepository' => $this->userRepository,
        ]);

        return $viewModel;

    }

    public function sendMessageAction()
    {
        $userId = $this->getUserId();

        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $post = $request->getPost();
        $content = (string)$post->get('content');
        $buddyId = (int)$post->get('buddyId');

        $this->messageCommand->sendMessage(
            new Message(
                $this->dialogRepository->getDialogId($userId, $buddyId),
                $userId,
                date('Y-m-d H:i:s'),
                $content,
            )
        );

        exit();
    }

    public function loadMessagesAction()
    {
        $userId = $this->getUserId();

        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $post = $request->getPost();
        $lastMessageId = $post->get('lastMessageId');
        $buddyId = (int)$post->get('buddyId');

        $messageList = $this->messageRepository->findMessagesOfDialog(
            $this->dialogRepository->getDialogId($userId, $buddyId),
            $lastMessageId,
        );

        $messageList = $this->messageCommand->readBy($userId, $messageList);

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('partial/message-list.phtml');
        $viewModel->setVariables([
            'messageList'    => $messageList,
            'userRepository' => $this->userRepository,
        ]);

        return $viewModel;
    }

    private function getUserId(): ?int
    {
        return $this->sessionContainer->offsetGet(LoginController::USER_ID);
    }
}

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
use Laminas\View\Model\ViewModel;

class MessengerController extends AbstractActionController
{
    /**
     * Maximum number of uploaded messages at a time.
     */
    public const MAX_MESSAGE_COUNT = 20;

    /**
     * @var DialogFilterForm
     */
    private DialogFilterForm $dialogFilterForm;
    /**
     * @var NewMessageForm
     */
    private NewMessageForm $newMessageForm;
    /**
     * @var DialogRepositoryInterface
     */
    private DialogRepositoryInterface $dialogRepository;
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;
    /**
     * @var PositionRepositoryInterface
     */
    private PositionRepositoryInterface $positionRepository;
    /**
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;
    /**
     * @var MessageCommandInterface
     */
    private MessageCommandInterface $messageCommand;

    /**
     * @param DialogFilterForm            $dialogFilterForm
     * @param NewMessageForm              $newMessageForm
     * @param DialogRepositoryInterface   $dialogRepository
     * @param UserRepositoryInterface     $userRepository
     * @param PositionRepositoryInterface $positionRepository
     * @param MessageRepositoryInterface  $messageRepository
     * @param MessageCommandInterface     $messageCommand
     */
    public function __construct(
        DialogFilterForm            $dialogFilterForm,
        NewMessageForm              $newMessageForm,
        DialogRepositoryInterface   $dialogRepository,
        UserRepositoryInterface     $userRepository,
        PositionRepositoryInterface $positionRepository,
        MessageRepositoryInterface  $messageRepository,
        MessageCommandInterface     $messageCommand
    ) {
        $this->dialogFilterForm = $dialogFilterForm;
        $this->newMessageForm = $newMessageForm;
        $this->dialogRepository = $dialogRepository;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->messageRepository = $messageRepository;
        $this->messageCommand = $messageCommand;
    }

    public function viewDialogListAction()
    {
        UserController::setAdminNavbar($this->userRepository, $this, UserController::USER_ID);
        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Диалоги');

        $dialogs = $this->dialogRepository->getDialogList(UserController::USER_ID);

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
        UserController::setAdminNavbar($this->userRepository, $this, UserController::USER_ID);
        $buddyId = (int)$this->params()->fromRoute('id', 0);

        if (
            $buddyId === 0 ||
            $buddyId === UserController::USER_ID
        ) {
            return $this->redirect()->toRoute('user/view-dialog-list');
        }

        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Сообщения');

        $userInfo = $this->userRepository->findUser(UserController::USER_ID);
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
                UserController::USER_ID,
                AdminController::getWhere($data)
            ),
            'userRepository' => $this->userRepository,
        ]);

        return $viewModel;

    }

    public function sendMessageAction()
    {
        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $post = $request->getPost();
        $content = (string)$post->get('content');
        $buddyId = (int)$post->get('buddyId');

        $this->messageCommand->sendMessage(
            new Message(
                $this->dialogRepository->getDialogId(UserController::USER_ID, $buddyId),
                UserController::USER_ID,
                date('Y-m-d H:i:s'),
                $content,
            )
        );

        exit();
    }

    public function loadMessagesAction()
    {
        $request = $this->getRequest();

        if (!$request->isXmlHttpRequest() || !$request->isPost()) {
            exit();
        }

        $post = $request->getPost();
        $lastMessageId = $post->get('lastMessageId');
        $buddyId = (int)$post->get('buddyId');

        $messageList = $this->messageRepository->findMessagesOfDialog(
            $this->dialogRepository->getDialogId(UserController::USER_ID, $buddyId),
            $lastMessageId,
        );

        $messageList = $this->messageCommand->readBy(UserController::USER_ID, $messageList);

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('partial/message-list.phtml');
        $viewModel->setVariables([
            'messageList'    => $messageList,
            'userRepository' => $this->userRepository,
        ]);

        return $viewModel;
    }
}

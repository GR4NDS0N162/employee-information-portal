<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\Repository\DialogRepositoryInterface;
use Application\Model\Repository\MessageRepositoryInterface;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class MessengerController extends AbstractActionController
{
    public const userId = 1;

    private $dialogFilterForm;
    private $newMessageForm;
    /**
     * @var DialogRepositoryInterface
     */
    private $dialogRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    public function __construct(
        $dialogFilterForm,
        $newMessageForm,
        $dialogRepository,
        $userRepository,
        $positionRepository,
        $messageRepository
    ) {
        $this->dialogFilterForm = $dialogFilterForm;
        $this->newMessageForm = $newMessageForm;
        $this->dialogRepository = $dialogRepository;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->messageRepository = $messageRepository;
    }

    public function viewDialogListAction()
    {
        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Диалоги');

        $dialogs = $this->dialogRepository->getDialogList(self::userId);

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
        $buddyId = (int)$this->params()->fromRoute('id', 0);

        if ($buddyId === 0) {
            return $this->redirect()->toRoute('user/view-dialog-list');
        }

        $viewModel = new ViewModel();

        $this->layout()->setVariable('headTitleName', 'Сообщения');

        $userInfo = $this->userRepository->findUser(self::userId);
        $buddyInfo = $this->userRepository->findUser($buddyId);
        $messages = $this->messageRepository->findMessagesOfDialog(
            $this->dialogRepository->getDialogId(self::userId, $buddyId)
        );

        $viewModel->setVariables([
            'newMessageForm' => $this->newMessageForm,
            'messages'       => $messages,
            'userRepository' => $this->userRepository,
            'userInfo'       => $userInfo,
            'buddyInfo'      => $buddyInfo,
        ]);

        return $viewModel;
    }
}

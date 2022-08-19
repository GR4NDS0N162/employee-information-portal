<?php

namespace Messenger\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Messenger\Model\DialogRepositoryInterface;

class DialogListController extends AbstractActionController
{
    private $dialogRepository;

    public function __construct($dialogRepository)
    {
        $this->dialogRepository = $dialogRepository;
    }

    public function indexAction()
    {
        $userId = 1;

        return new ViewModel([
            'dialogs' => $this->dialogRepository->findDialogsOfUser($userId),
        ]);
    }
}

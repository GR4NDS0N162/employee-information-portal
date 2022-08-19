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
        return new ViewModel([
            'dialogs' => $this->dialogRepository->findAllDialogs(),
        ]);
    }
}

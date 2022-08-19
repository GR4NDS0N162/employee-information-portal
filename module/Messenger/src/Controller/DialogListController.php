<?php
declare(strict_types=1);

namespace Messenger\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Messenger\Model\DialogRepositoryInterface;

/**
 *
 */
class DialogListController extends AbstractActionController
{
    /**
     * @var DialogRepositoryInterface
     */
    private DialogRepositoryInterface $dialogRepository;

    /**
     * @param DialogRepositoryInterface $dialogRepository
     */
    public function __construct(DialogRepositoryInterface $dialogRepository)
    {
        $this->dialogRepository = $dialogRepository;
    }

    /**
     * Default action if none provided
     *
     * @return ViewModel
     */
    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'dialogs' => $this->dialogRepository->findAllDialogs(),
        ]);
    }
}

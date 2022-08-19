<?php
declare(strict_types=1);

namespace Messenger\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
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
}

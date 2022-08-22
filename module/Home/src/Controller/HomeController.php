<?php

namespace Home\Controller;

use Home\Model\PositionRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;

class HomeController extends AbstractActionController
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    /**
     * @param PositionRepositoryInterface $positionRepository
     */
    public function __construct($positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }
}

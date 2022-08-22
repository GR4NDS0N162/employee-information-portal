<?php

namespace Home\Controller;

use Home\Model\PositionRepositoryInterface;
use Home\Model\UserRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;

class HomeController extends AbstractActionController
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param PositionRepositoryInterface $positionRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct($positionRepository, $userRepository)
    {
        $this->positionRepository = $positionRepository;
        $this->userRepository = $userRepository;
    }
}

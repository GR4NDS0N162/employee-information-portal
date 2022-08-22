<?php

namespace Home\Controller;

use Home\Model\EmailRepositoryInterface;
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
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @param PositionRepositoryInterface $positionRepository
     * @param UserRepositoryInterface $userRepository
     * @param EmailRepositoryInterface $emailRepository
     */
    public function __construct($positionRepository, $userRepository, $emailRepository)
    {
        $this->positionRepository = $positionRepository;
        $this->userRepository = $userRepository;
        $this->emailRepository = $emailRepository;
    }
}

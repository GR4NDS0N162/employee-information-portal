<?php

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use User\Model\EmailRepositoryInterface;
use User\Model\PhoneRepositoryInterface;

class ProfileController extends AbstractActionController
{
    /**
     * @var PhoneRepositoryInterface
     */
    private $phoneRepository;

    /**
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @param PhoneRepositoryInterface $phoneRepository
     * @param EmailRepositoryInterface $emailRepository
     */
    public function __construct(
        $phoneRepository,
        $emailRepository
    )
    {
        $this->phoneRepository = $phoneRepository;
        $this->emailRepository = $emailRepository;
    }
}

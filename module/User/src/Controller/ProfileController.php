<?php

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use User\Model\EmailRepositoryInterface;
use User\Model\PhoneRepositoryInterface;
use User\Model\ProfileRepositoryInterface;

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
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * @param PhoneRepositoryInterface $phoneRepository
     * @param EmailRepositoryInterface $emailRepository
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct(
        $phoneRepository,
        $emailRepository,
        $profileRepository
    )
    {
        $this->phoneRepository = $phoneRepository;
        $this->emailRepository = $emailRepository;
        $this->profileRepository = $profileRepository;
    }
}

<?php

namespace Application\Model\Repository;

use Application\Model\Entity\UserInfo;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorAwareInterface;

class UserInfoRepository implements UserInfoRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var  UserInfo|HydratorAwareInterface
     */
    private $prototype;
    /**
     * @var EmailRepositoryInterface
     */
    private $emailRepository;
    /**
     * @var PhoneRepositoryInterface
     */
    private $phoneRepository;
    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;
    /**
     * @var UserStatusRepositoryInterface
     */
    private $userStatusRepository;

    /**
     * @param AdapterInterface                $db
     * @param UserInfo|HydratorAwareInterface $prototype
     * @param EmailRepositoryInterface        $emailRepository
     * @param PhoneRepositoryInterface        $phoneRepository
     * @param StatusRepositoryInterface       $statusRepository
     * @param UserStatusRepositoryInterface   $userStatusRepository
     */
    public function __construct(
        $db,
        $prototype,
        $emailRepository,
        $phoneRepository,
        $statusRepository,
        $userStatusRepository
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->statusRepository = $statusRepository;
        $this->userStatusRepository = $userStatusRepository;
    }
}
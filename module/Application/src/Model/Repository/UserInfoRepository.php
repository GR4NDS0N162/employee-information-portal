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
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param AdapterInterface                $db
     * @param UserInfo|HydratorAwareInterface $prototype
     * @param UserRepositoryInterface         $userRepository
     * @param EmailRepositoryInterface        $emailRepository
     * @param PhoneRepositoryInterface        $phoneRepository
     * @param StatusRepositoryInterface       $statusRepository
     */
    public function __construct(
        $db,
        $prototype,
        $userRepository,
        $emailRepository,
        $phoneRepository,
        $statusRepository
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
        $this->userRepository = $userRepository;
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->statusRepository = $statusRepository;
    }

    public function findUsersInfo($where = [], $order = [])
    {
        // TODO: Implement findUsersInfo() method.
    }
}
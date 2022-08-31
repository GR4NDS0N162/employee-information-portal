<?php

namespace Application\Model\Repository;

use Application\Model\Entity\UserStatus;
use Application\Model\UserStatusRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class UserStatusRepository implements UserStatusRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var HydratorInterface
     */
    private $hydrator;
    /**
     * @var UserStatus
     */
    private $prototype;

    /**
     * @param AdapterInterface  $db
     * @param HydratorInterface $hydrator
     * @param UserStatus        $prototype
     */
    public function __construct($db, $hydrator, $prototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
    }

    public function findStatusesOfUser($userId)
    {
        // TODO: Implement findStatusesOfUser() method.
    }
}
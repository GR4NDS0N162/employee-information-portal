<?php

namespace Application\Model\Repository;

use Application\Model\Entity\User;
use Application\Model\UserRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class UserRepository implements UserRepositoryInterface
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
     * @var User
     */
    private $userPrototype;

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        User              $userPrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->userPrototype = $userPrototype;
    }

    public function findUser($identifier): User
    {
        // TODO: Implement findUser() method.
    }
}
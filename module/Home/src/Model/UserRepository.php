<?php

namespace Home\Model;

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

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param User $userPrototype
     */
    public function __construct($db, $hydrator, $userPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->userPrototype = $userPrototype;
    }

    public function findUser($id)
    {
        // TODO: Implement findUser() method.
    }
}

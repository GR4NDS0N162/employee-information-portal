<?php

namespace User\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class ProfileRepository implements ProfileRepositoryInterface
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
     * @var Profile
     */
    private $profilePrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Profile $profilePrototype
     */
    public function __construct($db, $hydrator, $profilePrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->profilePrototype = $profilePrototype;
    }

    public function findProfile($id)
    {
        // TODO: Implement findProfile() method.
    }
}

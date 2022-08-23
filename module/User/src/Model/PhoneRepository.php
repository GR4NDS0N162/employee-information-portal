<?php

namespace User\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class PhoneRepository implements PhoneRepositoryInterface
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
     * @var Phone
     */
    private $phonePrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Phone $phonePrototype
     */
    public function __construct($db, $hydrator, $phonePrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->phonePrototype = $phonePrototype;
    }

    public function findPhonesOfUser($userId)
    {
        // TODO: Implement findPhonesOfUser() method.
    }
}

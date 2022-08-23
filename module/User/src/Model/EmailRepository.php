<?php

namespace User\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class EmailRepository implements EmailRepositoryInterface
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
     * @var Email
     */
    private $emailPrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Email $emailPrototype
     */
    public function __construct($db, $hydrator, $emailPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->emailPrototype = $emailPrototype;
    }

    public function findEmailsOfUser($userId)
    {
        // TODO: Implement findEmailsOfUser() method.
    }
}

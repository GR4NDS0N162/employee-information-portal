<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
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

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        Email             $emailPrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->emailPrototype = $emailPrototype;
    }

    public function findEmailsOfUser(int $userId)
    {
        // TODO: Implement findEmailsOfUser() method.
    }
}
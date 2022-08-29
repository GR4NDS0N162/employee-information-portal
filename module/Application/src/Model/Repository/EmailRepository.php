<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;
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

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
    }

    public function findEmailsOfUser(int $userId): array
    {
        // TODO: Implement findEmailsOfUser() method.
    }
}
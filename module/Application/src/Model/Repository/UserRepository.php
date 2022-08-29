<?php

namespace Application\Model\Repository;

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

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
    }
}
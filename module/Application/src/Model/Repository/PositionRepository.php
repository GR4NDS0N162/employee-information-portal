<?php

namespace Application\Model\Repository;

use Application\Model\PositionRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class PositionRepository implements PositionRepositoryInterface
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

    public function findAllPositions(): array
    {
        // TODO: Implement findAllPositions() method.
    }
}
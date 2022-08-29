<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Position;
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

    /**
     * @var Position
     */
    private $positionPrototype;

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        Position          $positionPrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->positionPrototype = $positionPrototype;
    }

    public function findAllPositions(): array
    {
        // TODO: Implement findAllPositions() method.
    }
}
<?php

namespace Home\Model;

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

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Position $positionPrototype
     */
    public function __construct($db, $hydrator, $positionPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->positionPrototype = $positionPrototype;
    }

    public function findAllPositions()
    {
        // TODO: Implement findAllPositions() method.
    }

    public function findPosition($id)
    {
        // TODO: Implement findPosition() method.
    }
}

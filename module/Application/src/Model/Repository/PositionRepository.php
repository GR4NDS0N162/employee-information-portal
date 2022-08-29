<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Position;
use Application\Model\Extractor;
use Application\Model\PositionRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
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
        $sql = new Sql($this->db);

        $select = $sql->select('position');
        $select->columns([
            'id',
            'name',
        ]);

        return Extractor::extractArray(
            $sql,
            $select,
            $this->hydrator,
            $this->positionPrototype
        );
    }
}
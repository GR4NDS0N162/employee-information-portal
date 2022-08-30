<?php

namespace Application\Model\Repository;

use Application\Model\Executer;
use Application\Model\PositionRepositoryInterface;
use Laminas\Db\Sql\Sql;

class PositionRepository implements PositionRepositoryInterface
{
    private $db;
    private $hydrator;
    private $positionPrototype;

    public function __construct($db, $hydrator, $positionPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->positionPrototype = $positionPrototype;
    }

    public function findAllPositions()
    {
        $sql = new Sql($this->db);

        $select = $sql->select('position');
        $select->columns([
            'id',
            'name',
        ]);

        return Executer::extractArray(
            $sql,
            $select,
            $this->hydrator,
            $this->positionPrototype
        );
    }
}
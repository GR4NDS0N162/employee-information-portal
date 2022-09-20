<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Position;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;

class PositionRepository implements PositionRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;
    /**
     * @var Position
     */
    private Position $prototype;

    /**
     * @param AdapterInterface $db
     */
    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
        $this->prototype = new Position();
    }

    public function findAllPositions()
    {
        $select = new Select(['pos' => 'position']);
        $select->columns([
            'id'   => 'pos.id',
            'name' => 'pos.name',
        ], false);
        $select->order(['pos.name ASC']);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }

    public function findPositionById($id)
    {
        $select = new Select(['pos' => 'position']);
        $select->columns([
            'id'   => 'pos.id',
            'name' => 'pos.name',
        ], false);
        $select->where(['pos.id = ?' => $id]);

        return Extracter::extractValue(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }
}
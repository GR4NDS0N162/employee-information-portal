<?php

namespace Home\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

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

        $sql = new Sql($this->db);
        $select = $sql->select('position');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->positionPrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }

    public function findPosition($id)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('position');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving position with identifier "%d"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->positionPrototype);
        $resultSet->initialize($result);
        $position = $resultSet->current();

        if (!$position) {
            throw new InvalidArgumentException(sprintf(
                'Position with identifier "%d" not found.',
                $id
            ));
        }

        return $position;
    }
}

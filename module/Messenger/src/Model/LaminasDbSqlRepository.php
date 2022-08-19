<?php

namespace Messenger\Model;

use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\ReflectionHydrator;

class LaminasDbSqlRepository implements DialogRepositoryInterface
{
    private $db;

    private $hydrator;

    private $dialogPrototype;

    public function __construct($db, $hydrator, $dialogPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->dialogPrototype = $dialogPrototype;
    }

    public function findAllDialogs()
    {
        $sql = new Sql($this->db);
        $select = $sql->select('dialog');
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->dialogPrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }

    public function findDialog($id)
    {
        // TODO: Implement findDialog() method.
    }
}

<?php

namespace Messenger\Model;

use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\ReflectionHydrator;

class LaminasDbSqlRepository implements DialogRepositoryInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
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

        $resultSet = new HydratingResultSet(
            new ReflectionHydrator(),
            new Dialog()
        );
        $resultSet->initialize($result);
        return $resultSet;
    }

    public function findDialog($id)
    {
        // TODO: Implement findDialog() method.
    }
}

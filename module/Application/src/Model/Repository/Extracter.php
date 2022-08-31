<?php

namespace Application\Model\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\PreparableSqlInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\CollectionStrategy;
use stdClass;

class Extracter
{
    /**
     * @param PreparableSqlInterface $preparable
     * @param AdapterInterface       $db
     * @param HydratorInterface      $hydrator
     * @param object|null            $prototype
     *
     * @return array|object[]
     */
    public static function extractValues($preparable, $db, $hydrator, $prototype = null)
    {
        $sql = new Sql($db);
        $statement = $sql->prepareStatementForSqlObject($preparable);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($hydrator, $prototype);
        $resultSet->initialize($result);

        $strategy = new CollectionStrategy(
            $hydrator,
            get_class($prototype) ?: stdClass::class
        );
        return $strategy->hydrate($resultSet->toArray());
    }
}
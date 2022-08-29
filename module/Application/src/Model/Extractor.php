<?php

namespace Application\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class Extractor
{
    /**
     * @param Sql               $sql
     * @param Select            $select
     * @param HydratorInterface $hydrator
     * @param                   $prototype
     *
     * @return array|HydratingResultSet
     */
    public static function extractArray($sql, $select, $hydrator, $prototype)
    {
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($hydrator, $prototype);
        $resultSet->initialize($result);
        return $resultSet;
    }

    public static function extractValue(
        Sql               $sql,
        Select            $select,
        HydratorInterface $hydrator,
                          $prototype,
        string            $runtimeExceptionMessage,
        string            $invalidArgumentExceptionMessage
    ): object {
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException($runtimeExceptionMessage);
        }

        $resultSet = new HydratingResultSet($hydrator, $prototype);
        $resultSet->initialize($result);
        $object = $resultSet->current();

        if (!$object) {
            throw new InvalidArgumentException($invalidArgumentExceptionMessage);
        }

        return $object;
    }
}
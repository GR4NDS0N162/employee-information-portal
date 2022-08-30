<?php

namespace Application\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class Executer
{
    /**
     * @param Sql               $sql
     * @param Select            $select
     * @param HydratorInterface $hydrator
     * @param                   $prototype
     *
     * @return array|HydratingResultSet
     */
    public static function extractArray(
        Sql               $sql,
        Select            $select,
        HydratorInterface $hydrator,
                          $prototype
    ) {
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($hydrator, $prototype);
        $resultSet->initialize($result);
        return $resultSet;
    }

    /**
     * @param Sql               $sql
     * @param Select            $select
     * @param HydratorInterface $hydrator
     * @param                   $prototype
     * @param string            $runtimeExceptionMessage
     * @param string            $invalidArgumentExceptionMessage
     *
     * @return object
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public static function extractValue(
        Sql               $sql,
        Select            $select,
        HydratorInterface $hydrator,
                          $prototype,
        string            $runtimeExceptionMessage = 'Failed to retrieve the object; unknown database error.',
        string            $invalidArgumentExceptionMessage = 'Object not found.'
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

    /**
     * @param Sql    $sql
     * @param Insert $insert
     * @param string $runtimeExceptionMessage
     *
     * @return mixed|null
     * @throws RuntimeException
     */
    public static function insertValues(
        Sql    $sql,
        Insert $insert,
        string $runtimeExceptionMessage = 'Database error occurred during insert operation.'
    ) {
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException($runtimeExceptionMessage);
        }

        return $result->getGeneratedValue();
    }
}
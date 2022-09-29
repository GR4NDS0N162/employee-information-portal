<?php

namespace Application\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Combine;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\InsertIgnore;
use Laminas\Db\Sql\PreparableSqlInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Update;
use RuntimeException;

class Executer
{
    const COMBINE = 'combine';
    const DELETE = 'delete';
    const INSERT_IGNORE = 'insert ignore';
    const INSERT = 'insert';
    const SELECT = 'select';
    const UPDATE = 'update';

    public static function executeSql(
        PreparableSqlInterface $preparable,
        AdapterInterface       $db,
        string                 $operationDescription = 'sql',
        string                 $runtimeExceptionFormat = 'Database error occurred during %s operation.'
    ) {
        $sql = new Sql($db);
        $statement = $sql->prepareStatementForSqlObject($preparable);
        $result = $statement->execute();

        if ($preparable instanceof Combine) {
            $operationDescription = self::COMBINE;
        } elseif ($preparable instanceof Delete) {
            $operationDescription = self::DELETE;
        } elseif ($preparable instanceof InsertIgnore) {
            $operationDescription = self::INSERT_IGNORE;
        } elseif ($preparable instanceof Insert) {
            $operationDescription = self::INSERT;
        } elseif ($preparable instanceof Select) {
            $operationDescription = self::SELECT;
        } elseif ($preparable instanceof Update) {
            $operationDescription = self::UPDATE;
        }

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
                sprintf(
                    $runtimeExceptionFormat,
                    $operationDescription
                )
            );
        }

        return $result->getGeneratedValue();
    }
}
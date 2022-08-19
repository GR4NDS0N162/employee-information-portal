<?php

namespace Messenger\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\ReflectionHydrator;
use RuntimeException;

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

    public function findDialogsOfUser($userId)
    {
        $sql = new Sql($this->db);

        $selectD = $sql->select()
            ->columns([
                'id' => 'dialog_id',
            ])
            ->from(['m' => 'member'])
            ->where(['m.user_id = ?' => $userId]);

        $resultSelect = $selectD;

        $statement = $sql->prepareStatementForSqlObject($resultSelect);
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
        $sql = new Sql($this->db);
        $select = $sql->select('dialog');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving dialog with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->dialogPrototype);
        $resultSet->initialize($result);
        $dialog = $resultSet->current();

        if (!$dialog) {
            throw new InvalidArgumentException(sprintf(
                'Dialog with identifier "%s" not found.',
                $id
            ));
        }

        return $dialog;
    }
}

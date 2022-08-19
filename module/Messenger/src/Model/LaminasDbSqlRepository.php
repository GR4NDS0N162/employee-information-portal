<?php

namespace Messenger\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
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

    /**
     * @param $sql Sql
     * @param $select Select
     * @param $callback callable
     * @return array
     */
    public static function getArray($sql, $select, $callback)
    {
        $resultSetArray = self::getResultSetArray($sql, $select);

        return array_map($callback, $resultSetArray);
    }

    /**
     * @param $sql Sql
     * @param $select Select
     * @param $callback callable
     * @return array
     */
    public static function getResultSetArray($sql, $select)
    {
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (!($result instanceof ResultInterface && $result->isQueryResult())) {
            die('no data');
        }

        $resultSet = new ResultSet();
        $resultSet->initialize($result);
        return $resultSet->toArray();
    }

    public function findDialogsOfUser($userId)
    {
        $sql = new Sql($this->db);

        $dialogOfUser = $sql->select()
            ->columns(['dialog_id'])
            ->from('member')
            ->where(['user_id = ' . $userId]);

        $dialogOfUserArray = self::getArray(
            $sql, $dialogOfUser,
            function ($arr) {
                return $arr['dialog_id'];
            });

        $resultSelect = $sql->select()
            ->columns([
                'id'              => 'dialog_id',
                'buddyId'         => 'id',
                'buddyPhoto'      => 'image',
                'buddySurname'    => 'surname',
                'buddyName'       => 'name',
                'buddyPatronymic' => 'patronymic',
                'buddyPosition'   => 'position_id',
                'buddyAge'        => 'birthday',
                'buddyGender'     => 'gender',
            ], false)
            ->from('user')
            ->join('member',
                new Expression(
                    'id = user_id AND user_id != ? AND dialog_id IN (' . implode(', ', $dialogOfUserArray) . ')',
                    [$userId]
                ),
                [],
                Select::JOIN_LEFT);

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

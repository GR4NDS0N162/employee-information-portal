<?php

namespace User\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;

class ListRepository implements ListRepositoryInterface
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
     * @var ListItem
     */
    private $listItemPrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param ListItem $listItemPrototype
     */
    public function __construct($db, $hydrator, $listItemPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->listItemPrototype = $listItemPrototype;
    }

    public function findItemsOfUser($userId, $table)
    {
        $sql = new Sql($this->db);

        $select = $sql->select()
            ->columns([
                'userId' => 'user_id',
                'value',
            ], false)
            ->from($table)
            ->where(['user_id = ' . $userId]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->listItemPrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }
}

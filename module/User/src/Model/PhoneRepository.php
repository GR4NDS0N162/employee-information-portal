<?php

namespace User\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;

class PhoneRepository implements PhoneRepositoryInterface
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
     * @var Phone
     */
    private $phonePrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Phone $phonePrototype
     */
    public function __construct($db, $hydrator, $phonePrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->phonePrototype = $phonePrototype;
    }

    public function findPhonesOfUser($userId)
    {
        $sql = new Sql($this->db);

        $select = $sql->select('phone');
        $select->columns([
            'number',
            'userId' => 'user_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->phonePrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }
}

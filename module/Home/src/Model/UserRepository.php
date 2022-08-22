<?php

namespace Home\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
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
     * @var User
     */
    private $userPrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param User $userPrototype
     */
    public function __construct($db, $hydrator, $userPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->userPrototype = $userPrototype;
    }

    public function findUser($id)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('user');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving user with identifier "%d"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->userPrototype);
        $resultSet->initialize($result);
        $user = $resultSet->current();

        if (!$user) {
            throw new InvalidArgumentException(sprintf(
                'User with identifier "%d" not found.',
                $id
            ));
        }

        return $user;
    }
}

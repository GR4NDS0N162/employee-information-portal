<?php

namespace User\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class ProfileRepository implements ProfileRepositoryInterface
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
     * @var Profile
     */
    private $profilePrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Profile $profilePrototype
     */
    public function __construct($db, $hydrator, $profilePrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->profilePrototype = $profilePrototype;
    }

    public function findProfile($id)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('user');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving profile with identifier "%s"; unknown database error.',
                $id
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->profilePrototype);
        $resultSet->initialize($result);
        $profile = $resultSet->current();

        if (!$profile) {
            throw new InvalidArgumentException(sprintf(
                'Profile with identifier "%s" not found.',
                $id
            ));
        }

        return $profile;
    }
}

<?php

namespace Home\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class EmailRepository implements EmailRepositoryInterface
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
     * @var Email
     */
    private $emailPrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param Email $emailPrototype
     */
    public function __construct($db, $hydrator, $emailPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->emailPrototype = $emailPrototype;
    }

    public function findEmail($address)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('email');
        $select->where(['address = ?' => $address]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf(
                'Failed retrieving email with address "%s"; unknown database error.',
                $address
            ));
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->emailPrototype);
        $resultSet->initialize($result);
        $email = $resultSet->current();

        if (!$email) {
            throw new InvalidArgumentException(sprintf(
                'Email with address "%s" not found.',
                $address
            ));
        }

        return $email;
    }
}

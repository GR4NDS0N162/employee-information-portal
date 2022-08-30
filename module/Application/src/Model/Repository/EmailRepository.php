<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class EmailRepository implements EmailRepositoryInterface
{
    private $db;
    private $hydrator;
    private $prototype;

    /**
     * @param AdapterInterface  $db
     * @param HydratorInterface $hydrator
     * @param Email             $prototype
     */
    public function __construct($db, $hydrator, $prototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
    }

    public function findEmailsOfUser($userId)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('email');
        $select->columns([
            'address',
            'userId' => 'user_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        return Executer::extractArray(
            $sql,
            $select,
            $this->hydrator,
            $this->prototype,
        );
    }

    public function findEmail($address)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('email');
        $select->columns([
            'address',
            'userId' => 'user_id',
        ]);
        $select->where(['address = ?' => $address]);

        $email = Executer::extractValue(
            $sql,
            $select,
            $this->hydrator,
            $this->prototype,
            sprintf(
                'Failed retrieving email with address "%s"; unknown database error.',
                $address
            ),
            sprintf(
                'Email with address "%s" not found.',
                $address
            ),
        );

        if ($email instanceof Email) {
            return $email;
        }

        throw new RuntimeException(
            sprintf(
                'Failed retrieving email with address "%s"; unknown repository error.',
                $address
            )
        );
    }
}
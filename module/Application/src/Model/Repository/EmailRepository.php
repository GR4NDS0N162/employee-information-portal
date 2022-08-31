<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Hydrator\HydratorInterface;

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
        $select = new Select('email');
        $select->columns([
            'address',
            'userId' => 'user_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        return Extracter::extractValues($select, $this->db, $this->hydrator, $this->prototype);
    }

    public function findEmail($address)
    {
        $select = new Select('email');
        $select->columns([
            'address',
            'userId' => 'user_id',
        ]);
        $select->where(['address = ?' => $address]);

        return Extracter::extractValue($select, $this->db, $this->hydrator, $this->prototype);
    }
}
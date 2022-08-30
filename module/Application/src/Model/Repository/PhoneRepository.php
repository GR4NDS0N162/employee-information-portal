<?php

namespace Application\Model\Repository;

use Application\Model\Executer;
use Application\Model\PhoneRepositoryInterface;
use Laminas\Db\Sql\Sql;

class PhoneRepository implements PhoneRepositoryInterface
{
    private $db;
    private $hydrator;
    private $phonePrototype;

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

        return Executer::extractArray(
            $sql,
            $select,
            $this->hydrator,
            $this->phonePrototype,
        );
    }
}
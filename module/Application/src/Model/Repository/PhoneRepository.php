<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Phone;
use Application\Model\Executer;
use Application\Model\PhoneRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
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

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        Phone             $phonePrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->phonePrototype = $phonePrototype;
    }

    public function findPhonesOfUser(int $userId)
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
<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Phone;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
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
    private $prototype;

    /**
     * @param AdapterInterface  $db
     * @param HydratorInterface $hydrator
     * @param Phone             $prototype
     */
    public function __construct($db, $hydrator, $prototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
    }

    public function findPhonesOfUser($userId)
    {
        $select = new Select('phone');
        $select->columns([
            'number',
            'userId' => 'user_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        return Extracter::extractValues($select, $this->db, $this->hydrator, $this->prototype);
    }
}
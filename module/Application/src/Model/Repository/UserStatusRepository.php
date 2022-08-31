<?php

namespace Application\Model\Repository;

use Application\Model\Entity\UserStatus;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Hydrator\HydratorInterface;

class UserStatusRepository implements UserStatusRepositoryInterface
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
     * @var UserStatus
     */
    private $prototype;

    /**
     * @param AdapterInterface  $db
     * @param HydratorInterface $hydrator
     * @param UserStatus        $prototype
     */
    public function __construct($db, $hydrator, $prototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
    }

    public function findStatusesOfUser($userId)
    {
        $select = new Select('user_status');
        $select->columns([
            'userId'   => 'user_id',
            'statusId' => 'status_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        return Extracter::extractValues($select, $this->db, $this->hydrator, $this->prototype);
    }
}
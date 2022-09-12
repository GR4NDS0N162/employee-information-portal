<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Status;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorAwareInterface;

class StatusRepository implements StatusRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var Status|HydratorAwareInterface
     */
    private $prototype;

    /**
     * @param AdapterInterface              $db
     * @param Status|HydratorAwareInterface $prototype
     */
    public function __construct($db, $prototype)
    {
        $this->db = $db;
        $this->prototype = $prototype;
    }

    public function findAllStatuses()
    {
        $sql = new Sql($this->db);
        $select = $sql->select('status');
        $select->columns([
            'id',
            'name',
        ]);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }

    public function findStatusesOfUser($userId)
    {
        $select = new Select('user_status');
        $select->columns([
            'id',
            'name',
        ], false);
        $select->join('status', 'status_id = id');
        $select->where(['user_id = ?' => $userId]);

        /** @var Status[] $statuses */
        $statuses = Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );

        return $statuses;
    }
}
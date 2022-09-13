<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Status;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
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
        $select = new Select(['s' => 'status']);
        $select->columns([
            'id'    => 's.id',
            'name'  => 's.name',
            'label' => 's.label',
        ], false);

        /** @var Status[] $statuses */
        $statuses = Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );

        return $statuses;
    }

    public function findStatusesOfUser($userId)
    {
        $select = new Select(['us' => 'user_status']);
        $select->where(['us.user_id = ?' => $userId]);
        $select->join(
            ['s' => 'status'],
            'us.status_id = s.id',
            [],
        );
        $select->columns([
            'id'    => 's.id',
            'name'  => 's.name',
            'label' => 's.label',
        ], false);

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
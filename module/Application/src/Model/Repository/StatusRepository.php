<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Status;
use Application\Model\Entity\UserStatus;
use Application\Model\Executer;
use Application\Model\StatusRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;

class StatusRepository implements StatusRepositoryInterface
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
     * @var Status
     */
    private $statusPrototype;

    /**
     * @var UserStatus
     */
    private $userStatusPrototype;

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        Status            $statusPrototype,
        UserStatus        $userStatusPrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->statusPrototype = $statusPrototype;
        $this->userStatusPrototype = $userStatusPrototype;
    }

    public function findAllStatuses()
    {
        $sql = new Sql($this->db);
        $select = $sql->select('status');
        $select->columns([
            'id',
            'name',
        ]);

        return Executer::extractArray(
            $sql,
            $select,
            $this->hydrator,
            $this->statusPrototype,
        );
    }

    public function findStatusesOfUser(int $userId)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('user_status');
        $select->columns([
            'userId'   => 'user_id',
            'statusId' => 'status_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        return Executer::extractArray(
            $sql,
            $select,
            $this->hydrator,
            $this->userStatusPrototype,
        );
    }

    public function generateStatusMapOfUser(int $userId): array
    {
        $userStatuses = $this->findStatusesOfUser($userId)->toArray();

        $statusMap = [];
        foreach ($this->findAllStatuses() as $status) {
            $statusMap[$status->getName()] = in_array(
                [
                    'statusId' => $status->getId(),
                    'userId'   => $userId,
                ],
                $userStatuses
            );
        }

        return $statusMap;
    }
}
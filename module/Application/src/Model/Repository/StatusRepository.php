<?php

namespace Application\Model\Repository;

use Application\Model\Executer;
use Application\Model\StatusRepositoryInterface;
use Laminas\Db\Sql\Sql;

class StatusRepository implements StatusRepositoryInterface
{
    private $db;
    private $hydrator;
    private $statusPrototype;
    private $userStatusPrototype;

    public function __construct($db, $hydrator, $statusPrototype, $userStatusPrototype)
    {
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

    public function findStatusesOfUser($userId)
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

    public function generateStatusMapOfUser($userId)
    {
        $userStatuses = $this->findStatusesOfUser($userId);

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
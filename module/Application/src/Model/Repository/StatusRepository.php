<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Status;
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

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        Status            $statusPrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->statusPrototype = $statusPrototype;
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
}
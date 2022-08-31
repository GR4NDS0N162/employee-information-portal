<?php

namespace Application\Model\Repository;

use Application\Model\StatusRepositoryInterface;
use Laminas\Db\Sql\Sql;

class StatusRepository implements StatusRepositoryInterface
{
    private $db;
    private $hydrator;
    private $prototype;

    public function __construct($db, $hydrator, $prototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
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

        return Extracter::extractValues($select, $this->db, $this->hydrator, $this->prototype);
    }
}
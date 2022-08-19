<?php

namespace Messenger\Model;

class LaminasDbSqlRepository implements DialogRepositoryInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAllDialogs()
    {
        // TODO: Implement findAllDialogs() method.
    }

    public function findDialog($id)
    {
        // TODO: Implement findDialog() method.
    }
}

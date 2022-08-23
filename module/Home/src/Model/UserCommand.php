<?php

namespace Home\Model;

use Laminas\Db\Adapter\AdapterInterface;

class UserCommand implements UserCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @param AdapterInterface $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertUser($user)
    {
        // TODO: Implement insertUser() method.
    }
}

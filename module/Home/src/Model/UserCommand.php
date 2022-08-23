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
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @param AdapterInterface $db
     */
    public function __construct($db, $emailRepository)
    {
        $this->db = $db;
        $this->emailRepository = $emailRepository;
    }

    public function insertUser($user, $email)
    {
        // TODO: Implement insertUser() method.
    }
}

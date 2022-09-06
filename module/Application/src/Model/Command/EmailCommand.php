<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;

class EmailCommand implements EmailCommandInterface
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

    public function updateEmails($oldList, $newList)
    {
        // TODO: Implement updateEmails() method.
    }

    public function deleteEmailByAddress($address)
    {
        $delete = new Delete('email');
        $delete->where(['address = ?' => $address]);

        Executer::executeSql($delete, $this->db);
    }

    public function addEmail($email)
    {
        // TODO: Implement addEmail() method.
    }
}
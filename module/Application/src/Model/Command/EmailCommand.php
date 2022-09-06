<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;

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

    public function updateEmails($userId, $oldList, $newList)
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
        $insert = new Insert('email');
        $insert->values([
            'user_id' => $email->getUserId(),
            'address' => $email->getAddress(),
        ]);

        Executer::executeSql($insert, $this->db);
    }
}
<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;
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
        $oldAddressList = array_column($oldList, 'address');
        $newAddressList = array_column($newList, 'address');

        foreach ($oldAddressList as $address) {
            if (!in_array($address, $newAddressList)) {
                $this->deleteEmailByAddress($address);
            }
        }

        foreach ($newAddressList as $address) {
            if (!in_array($address, $oldAddressList)) {
                $this->addEmail(new Email($address, $userId));
            }
        }
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
<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;

class EmailCommand implements EmailCommandInterface
{
    private AdapterInterface $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function updateEmails(int $userId, array $oldList, array $newList)
    {
        $oldAddressList = array_column($oldList, 'address');
        $newAddressList = array_column($newList, 'address');

        $toDelete = array_diff($oldAddressList, $newAddressList);
        $toAdd = array_diff($newAddressList, $oldAddressList);

        $delete = new Delete('email');
        $delete->where(['address' => $toDelete]);
        Executer::executeSql($delete, $this->db);

        $insert = new Insert('email');
        foreach ($toAdd as $address) {
            $insert->values([
                'address' => $address,
                'user_id' => $userId,
            ]);
            Executer::executeSql($insert, $this->db);
        }
    }
}
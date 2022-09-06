<?php

namespace Application\Model\Command;

use Application\Model\Entity\Phone;
use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;

class PhoneCommand implements PhoneCommandInterface
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

    public function updatePhones($oldList, $newList)
    {
        $oldNumberList = array_column($oldList, 'number');
        $newNumberList = array_column($newList, 'number');

        foreach ($oldList as $phone) {
            if (!in_array($phone->getNumber(), $newNumberList)) {
                $this->deletePhoneByNumber($phone->getNumber());
            }
        }

        foreach ($newList as $phone) {
            if (!in_array($phone->getNumber(), $oldNumberList)) {
                $this->addPhone($phone);
            }
        }
    }

    /**
     * @param string $number
     *
     * @return void
     */
    private function deletePhoneByNumber($number)
    {
        $delete = new Delete('phone');
        $delete->where(['number = ?' => $number]);

        Executer::executeSql($delete, $this->db);
    }

    /**
     * @param Phone $phone
     *
     * @return void
     */
    private function addPhone($phone)
    {
        $insert = new Insert('phone');
        $insert->values([
            'user_id' => $phone->getUserId(),
            'number'  => $phone->getNumber(),
        ]);

        Executer::executeSql($insert, $this->db);
    }
}
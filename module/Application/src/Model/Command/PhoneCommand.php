<?php

namespace Application\Model\Command;

use Application\Model\Entity\Phone;
use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;

class PhoneCommand implements PhoneCommandInterface
{
    private AdapterInterface $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function updatePhones(int $userId, array $oldList, array $newList)
    {
        $oldNumberList = array_column($oldList, 'number');
        $newNumberList = array_column($newList, 'number');

        foreach ($oldNumberList as $number) {
            if (!in_array($number, $newNumberList)) {
                $this->deletePhoneByNumber($number);
            }
        }

        foreach ($newNumberList as $number) {
            if (!in_array($number, $oldNumberList)) {
                $this->addPhone(new Phone($number, $userId));
            }
        }
    }

    private function deletePhoneByNumber(string $number)
    {
        $delete = new Delete('phone');
        $delete->where(['number = ?' => $number]);

        Executer::executeSql($delete, $this->db);
    }

    private function addPhone(Phone $phone)
    {
        $insert = new Insert('phone');
        $insert->values([
            'user_id' => $phone->getUserId(),
            'number'  => $phone->getNumber(),
        ]);

        Executer::executeSql($insert, $this->db);
    }
}
<?php

namespace Application\Model;

use Application\Model\Entity\Phone;
use Laminas\Db\ResultSet\HydratingResultSet;

interface PhoneRepositoryInterface
{
    /**
     * @param integer $userId
     *
     * @return Phone[]|HydratingResultSet
     */
    public function findPhonesOfUser(int $userId);
}
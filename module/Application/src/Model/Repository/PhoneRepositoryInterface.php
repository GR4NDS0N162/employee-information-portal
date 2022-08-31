<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Phone;

interface PhoneRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return Phone[]
     */
    public function findPhonesOfUser($userId);
}
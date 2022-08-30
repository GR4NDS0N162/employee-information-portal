<?php

namespace Application\Model;

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
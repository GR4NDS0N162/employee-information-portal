<?php

namespace Application\Model;

use Application\Model\Entity\Phone;

interface PhoneRepositoryInterface
{
    /**
     * @param integer $userId
     *
     * @return Phone[]
     */
    public function findPhonesOfUser(int $userId);
}
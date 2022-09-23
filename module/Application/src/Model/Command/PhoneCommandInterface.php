<?php

namespace Application\Model\Command;

use Application\Model\Entity\Phone;

interface PhoneCommandInterface
{
    /**
     * @param int     $userId
     * @param Phone[] $oldList
     * @param Phone[] $newList
     *
     * @return void
     */
    public function updatePhones(int $userId, array $oldList, array $newList);
}
<?php

namespace Application\Model\Command;

use Application\Model\Entity\Phone;

interface PhoneCommandInterface
{
    /**
     * @param Phone[] $oldList
     * @param Phone[] $newList
     *
     * @return void
     */
    public function updatePhones($oldList, $newList);

    /**
     * @param string $number
     *
     * @return void
     */
    public function deletePhoneByNumber($number);

    /**
     * @param Phone $phone
     *
     * @return void
     */
    public function addPhone($phone);
}
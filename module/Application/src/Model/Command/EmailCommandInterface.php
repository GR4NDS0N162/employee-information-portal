<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;

interface EmailCommandInterface
{
    /**
     * @param Email[] $oldList
     * @param Email[] $newList
     *
     * @return void
     */
    public function updateEmails($oldList, $newList);

    /**
     * @param string $address
     *
     * @return void
     */
    public function deleteEmailByAddress($address);

    /**
     * @param Email $email
     *
     * @return void
     */
    public function addEmail($email);
}
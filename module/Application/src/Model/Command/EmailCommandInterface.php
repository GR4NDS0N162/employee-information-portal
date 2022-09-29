<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;

interface EmailCommandInterface
{
    /**
     * @param int     $userId
     * @param Email[] $oldList
     * @param Email[] $newList
     *
     * @return void
     */
    public function updateEmails(int $userId, array $oldList, array $newList);
}
<?php

namespace Application\Model\Command;

interface DialogCommandInterface
{
    /**
     * @param int $userId
     * @param int $buddyId
     *
     * @return int
     */
    public function createDialog(int $userId, int $buddyId): int;
}
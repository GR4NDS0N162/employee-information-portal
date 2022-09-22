<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Dialog;

interface DialogRepositoryInterface
{
    /**
     * @param int   $userId
     * @param array $whereConfig
     *
     * @return Dialog[]
     */
    public function getDialogList(int $userId, array $whereConfig = []);

    /**
     * @param int $userId
     * @param int $buddyId
     *
     * @return int
     */
    public function getDialogId($userId, $buddyId);
}
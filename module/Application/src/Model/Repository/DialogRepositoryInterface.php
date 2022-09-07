<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Dialog;

interface DialogRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return Dialog[]
     */
    public function getDialogList($userId);
}
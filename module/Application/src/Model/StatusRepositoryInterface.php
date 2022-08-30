<?php

namespace Application\Model;

use Application\Model\Entity\Status;
use Application\Model\Entity\UserStatus;

interface StatusRepositoryInterface
{
    /**
     * @return Status[]
     */
    public function findAllStatuses();

    /**
     * @param int $userId
     *
     * @return UserStatus[]
     */
    public function findStatusesOfUser(int $userId);

    /**
     * @param int $userId
     *
     * @return bool[]
     */
    public function generateStatusMapOfUser(int $userId);
}
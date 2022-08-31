<?php

namespace Application\Model\Repository;

use Application\Model\Entity\UserStatus;

interface UserStatusRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return UserStatus[]
     */
    public function findStatusesOfUser($userId);
}
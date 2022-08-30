<?php

namespace Application\Model;

use Application\Model\Entity\Status;
use Application\Model\Entity\UserStatus;
use Laminas\Db\ResultSet\HydratingResultSet;

interface StatusRepositoryInterface
{
    /**
     * @return Status[]|HydratingResultSet
     */
    public function findAllStatuses();

    /**
     * @param int $userId
     *
     * @return UserStatus[]|HydratingResultSet
     */
    public function findStatusesOfUser(int $userId);
}
<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Status;

interface StatusRepositoryInterface
{
    /**
     * @return Status[]
     */
    public function findAllStatuses();

    /**
     * @param int $userId
     *
     * @return Status[]
     */
    public function findStatusesOfUser($userId);

    /**
     * @param int        $userId
     * @param int|string $statusIdentifier
     *
     * @return bool
     */
    public function checkStatusOfUser(int $userId, $statusIdentifier): bool;
}
<?php

namespace Application\Model;

use Application\Model\Entity\Status;

interface StatusRepositoryInterface
{
    /**
     * @return Status[]
     */
    public function findAllStatuses();
}
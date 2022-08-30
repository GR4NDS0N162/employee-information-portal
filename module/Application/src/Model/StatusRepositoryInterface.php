<?php

namespace Application\Model;

use Application\Model\Entity\Status;
use Laminas\Db\ResultSet\HydratingResultSet;

interface StatusRepositoryInterface
{
    /**
     * @return Status[]|HydratingResultSet
     */
    public function findAllStatuses();
}
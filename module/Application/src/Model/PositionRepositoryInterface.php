<?php

namespace Application\Model;

use Application\Model\Entity\Position;
use Laminas\Db\ResultSet\HydratingResultSet;

interface PositionRepositoryInterface
{
    /**
     * @return Position[]|HydratingResultSet
     */
    public function findAllPositions();
}
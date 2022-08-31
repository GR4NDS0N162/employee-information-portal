<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Position;

interface PositionRepositoryInterface
{
    /**
     * @return Position[]
     */
    public function findAllPositions();
}
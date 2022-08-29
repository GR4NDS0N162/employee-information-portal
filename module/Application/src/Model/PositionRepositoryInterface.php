<?php

namespace Application\Model;

use Application\Model\Entity\Position;

interface PositionRepositoryInterface
{
    /**
     * @return Position[]
     */
    public function findAllPositions(): array;
}
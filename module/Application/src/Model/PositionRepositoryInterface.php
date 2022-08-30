<?php

namespace Application\Model;

use Application\Model\Entity\Position;

interface PositionRepositoryInterface
{
    public function findAllPositions();
}
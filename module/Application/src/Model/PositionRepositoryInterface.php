<?php

namespace Application\Model;

interface PositionRepositoryInterface
{
    /**
     * @return Position[]
     */
    public function findAllPositions(): array;
}
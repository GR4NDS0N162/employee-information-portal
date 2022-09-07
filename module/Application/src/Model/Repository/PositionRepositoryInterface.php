<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Position;

interface PositionRepositoryInterface
{
    /**
     * @return Position[]
     */
    public function findAllPositions();

    /**
     * @param int $id
     *
     * @return Position
     */
    public function findPositionById($id);
}
<?php

namespace Application\Model\Command;

use Application\Model\Entity\Position;
use Application\Model\Entity\PositionList;

interface PositionCommandInterface
{
    /**
     * @param PositionList $positionList
     *
     * @return void
     */
    public function updatePositions(PositionList $positionList);

    /**
     * @param int $id
     *
     * @return void
     */
    public function deletePositionById(int $id);

    /**
     * @param Position $position
     *
     * @return void
     */
    public function addPosition(Position $position);

    /**
     * @param Position $position
     *
     * @return void
     */
    public function updatePosition(Position $position);
}
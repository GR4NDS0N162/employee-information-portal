<?php

namespace Application\Model\Command;

use Application\Model\Entity\PositionList;

interface PositionCommandInterface
{
    /**
     * @param PositionList $positionList
     *
     * @return void
     */
    public function updatePositions($positionList);

    /**
     * @param int $id
     *
     * @return void
     */
    public function deletePositionById($id);
}
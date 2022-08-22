<?php

namespace Home\Model;

interface PositionRepositoryInterface
{
    /**
     * @return Position[]
     */
    public function findAllPositions();

    /**
     * @param $id positive-int
     * @return Position
     */
    public function findPosition($id);
}

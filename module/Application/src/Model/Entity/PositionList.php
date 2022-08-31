<?php

namespace Application\Model\Entity;

class PositionList
{
    /**
     * @var Position[]
     */
    private $list;

    /**
     * @param Position[] $list
     */
    public function __construct($list = [])
    {
        $this->list = $list;
    }

    /**
     * @return Position[]
     */
    public function getList()
    {
        return $this->list;
    }
}
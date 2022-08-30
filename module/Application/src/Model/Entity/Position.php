<?php

namespace Application\Model\Entity;

class Position
{
    private $id;
    private $name;

    public function __construct(
        $name = '',
        $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
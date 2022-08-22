<?php

namespace Home\Model;

class Position
{
    /**
     * @var positive-int|null
     */
    private $id;

    /**
     * @var non-empty-string
     */
    private $name;

    /**
     * @param int|null $id
     * @param string $name
     */
    public function __construct($name, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

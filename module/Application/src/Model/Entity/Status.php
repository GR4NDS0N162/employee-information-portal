<?php

namespace Application\Model\Entity;

class Status
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * @param string   $name
     * @param int|null $id
     */
    public function __construct(
        $name = '',
        $id = null
    ) {
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
<?php

namespace Application\Model\Entity;

class Phone
{
    /**
     * @var string
     */
    private $number;
    /**
     * @var int|null
     */
    private $userId;

    /**
     * @param string   $number
     * @param int|null $userId
     */
    public function __construct(
        $number = '',
        $userId = null
    ) {
        $this->number = $number;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
<?php

namespace User\Model;

class Phone
{
    /**
     * @var non-empty-string
     */
    private $number;

    /**
     * @var positive-int|null
     */
    private $userId;

    /**
     * @param string $number
     * @param int|null $userId
     */
    public function __construct($number, $userId = null)
    {
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

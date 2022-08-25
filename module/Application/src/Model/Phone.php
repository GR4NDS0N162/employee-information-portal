<?php

namespace Application\Model;

class Phone
{
    private $number;
    private $userId;

    public function __construct($number,
                                $userId)
    {
        $this->number = $number;
        $this->userId = $userId;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
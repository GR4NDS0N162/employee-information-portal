<?php

namespace Application\Model\Entity;

class Phone
{
    private $number;
    private $userId;

    public function __construct(
        $number = '',
        $userId = null
    ) {
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
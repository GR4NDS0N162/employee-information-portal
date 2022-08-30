<?php

namespace Application\Model\Entity;

class Email
{
    private $address;
    private $userId;

    public function __construct(
        $address = '',
        $userId = null
    ) {
        $this->address = $address;
        $this->userId = $userId;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
<?php

namespace Application\Model;

class Email
{
    private $address;
    private $userId;

    public function __construct($address,
                                $userId)
    {
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
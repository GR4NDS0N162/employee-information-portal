<?php

namespace Application\Model\Entity;

class Email
{
    /**
     * @var string
     */
    private $address;
    /**
     * @var int|null
     */
    private $userId;

    /**
     * @param string   $address
     * @param int|null $userId
     */
    public function __construct(
        $address = '',
        $userId = null
    ) {
        $this->address = $address;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
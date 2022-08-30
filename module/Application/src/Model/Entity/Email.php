<?php

namespace Application\Model\Entity;

class Email
{
    private string $address;
    private ?int $userId;

    public function __construct(
        string $address = '',
        ?int   $userId = null
    ) {
        $this->address = $address;
        $this->userId = $userId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
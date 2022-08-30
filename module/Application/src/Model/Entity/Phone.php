<?php

namespace Application\Model\Entity;

class Phone
{
    private string $number;
    private ?int $userId;

    public function __construct(
        string $number = '',
        ?int   $userId = null
    ) {
        $this->number = $number;
        $this->userId = $userId;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
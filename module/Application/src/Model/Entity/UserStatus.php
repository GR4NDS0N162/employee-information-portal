<?php

namespace Application\Model\Entity;

class UserStatus
{
    private int $userId;
    private int $statusId;

    public function __construct(
        int $userId = 0,
        int $statusId = 0
    ) {
        $this->userId = $userId;
        $this->statusId = $statusId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }
}
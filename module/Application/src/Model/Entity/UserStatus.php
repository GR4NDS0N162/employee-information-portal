<?php

namespace Application\Model\Entity;

class UserStatus
{
    private $userId;
    private $statusId;

    public function __construct(
        $userId = 0,
        $statusId = 0
    ) {
        $this->userId = $userId;
        $this->statusId = $statusId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }
}
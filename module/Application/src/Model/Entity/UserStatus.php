<?php

namespace Application\Model\Entity;

class UserStatus
{
    /**
     * @var int|null
     */
    private $userId;
    /**
     * @var int
     */
    private $statusId;

    /**
     * @param int|null $userId
     * @param int      $statusId
     */
    public function __construct(
        $statusId = 0,
        $userId = null
    ) {
        $this->userId = $userId;
        $this->statusId = $statusId;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }
}
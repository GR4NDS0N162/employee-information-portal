<?php

namespace Application\Model\Entity;

class User extends Profile
{
    protected $positionId;
    protected $status;

    public function __construct(
        $positionId = 0,
        $status = [],
        $password = '',
        $emails = [],
        $phones = [],
        $tempPassword = null,
        $tpCreatedAt = null,
        $surname = null,
        $name = null,
        $patronymic = null,
        $gender = null,
        $birthday = null,
        $image = null,
        $skype = null,
        $id = null
    ) {
        parent::__construct(
            $password,
            $emails,
            $phones,
            $tempPassword,
            $tpCreatedAt,
            $surname,
            $name,
            $patronymic,
            $gender,
            $birthday,
            $image,
            $skype,
            $id
        );

        $this->positionId = $positionId;
        $this->status = $status;
    }

    public function getPositionId()
    {
        return $this->positionId;
    }

    public function setPositionId($positionId)
    {
        $this->positionId = $positionId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
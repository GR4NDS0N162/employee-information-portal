<?php

namespace Application\Model\Entity;

class User extends Profile
{
    protected int $positionId;
    protected array $status;

    public function __construct(
        int     $positionId = 0,
        array   $status = [],
        string  $password = '',
        array   $emails = [],
        array   $phones = [],
        ?string $tempPassword = null,
        ?string $tpCreatedAt = null,
        ?string $surname = null,
        ?string $name = null,
        ?string $patronymic = null,
        ?int    $gender = null,
        ?string $birthday = null,
        ?string $image = null,
        ?string $skype = null,
        ?int    $id = null
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

    public function getPositionId(): int
    {
        return $this->positionId;
    }

    public function setPositionId(int $positionId): void
    {
        $this->positionId = $positionId;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    public function setStatus(array $status): void
    {
        $this->status = $status;
    }
}
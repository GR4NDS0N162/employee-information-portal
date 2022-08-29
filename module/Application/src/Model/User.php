<?php

namespace Application\Model;

class User extends Profile
{
    protected int $positionId;
    protected array $status;

    public function __construct($password,
                                $tempPassword,
                                $tpCreatedAt,
                                $position,
                                $surname,
                                $name,
                                $patronymic,
                                $gender,
                                $birthday,
                                $image,
                                $skype,
                                $emails,
                                $phones,
                                $status,
                                $id = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->tempPassword = $tempPassword;
        $this->tpCreatedAt = $tpCreatedAt;
        $this->position = $position;
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->skype = $skype;
        $this->emails = $emails;
        $this->phones = $phones;
        $this->status = $status;
    }

    public function getPositionId(): int
    {
        return $this->positionId;
    }

    public function getStatus(): array
    {
        return $this->status;
    }
}
<?php

namespace Application\Model;

class Profile
{
    private $id;
    private $password;
    private $tempPassword;
    private $tpCreatedAt;
    private $positionId;
    private $surname;
    private $name;
    private $patronymic;
    private $gender;
    private $birthday;
    private $image;
    private $skype;
    private $emails;
    private $phones;

    public function __construct($password,
                                $tempPassword,
                                $tpCreatedAt,
                                $positionId,
                                $surname,
                                $name,
                                $patronymic,
                                $gender,
                                $birthday,
                                $image,
                                $skype,
                                $emails,
                                $phones,
                                $id = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->tempPassword = $tempPassword;
        $this->tpCreatedAt = $tpCreatedAt;
        $this->positionId = $positionId;
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->skype = $skype;
        $this->emails = $emails;
        $this->phones = $phones;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getTempPassword()
    {
        return $this->tempPassword;
    }

    public function getTpCreatedAt()
    {
        return $this->tpCreatedAt;
    }

    public function getPositionId()
    {
        return $this->positionId;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPatronymic()
    {
        return $this->patronymic;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getSkype()
    {
        return $this->skype;
    }

    public function getEmails()
    {
        return $this->emails;
    }

    public function getPhones()
    {
        return $this->phones;
    }
}
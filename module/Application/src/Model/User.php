<?php

namespace Application\Model;

class User
{
    private $id;
    private $password;
    private $tempPassword;
    private $tpCreatedAt;
    private $position;
    private $surname;
    private $name;
    private $patronymic;
    private $gender;
    private $birthday;
    private $image;
    private $skype;
    private $emails;
    private $phones;
    private $status;

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

    public function getPosition()
    {
        return $this->position;
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

    public function getStatus()
    {
        return $this->status;
    }
}
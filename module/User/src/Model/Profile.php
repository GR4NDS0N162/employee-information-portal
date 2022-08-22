<?php

namespace User\Model;

class Profile
{
    private $id;
    private $photo;
    private $surname;
    private $name;
    private $patronymic;
    private $gender;
    private $birthday;
    private $skype;

    public function __construct($id, $photo, $surname, $name, $patronymic, $gender, $birthday, $skype)
    {
        $this->id = $id;
        $this->photo = $photo;
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->skype = $skype;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPhoto()
    {
        return $this->photo;
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

    public function getSkype()
    {
        return $this->skype;
    }
}

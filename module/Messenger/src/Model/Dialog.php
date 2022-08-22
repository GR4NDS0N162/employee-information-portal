<?php

namespace Messenger\Model;

class Dialog
{
    private $id;

    private $buddyId;
    private $buddyPhoto;
    private $buddySurname;
    private $buddyName;
    private $buddyPatronymic;
    private $buddyPosition;
    private $buddyAge;
    private $buddyGender;

    public function __construct(
        $buddyId,
        $buddyPhoto,
        $buddySurname,
        $buddyName,
        $buddyPatronymic,
        $buddyPosition,
        $buddyAge,
        $buddyGender,
        $id = null)
    {
        $this->id = $id;
        $this->buddyId = $buddyId;
        $this->buddyPhoto = $buddyPhoto;
        $this->buddySurname = $buddySurname;
        $this->buddyName = $buddyName;
        $this->buddyPatronymic = $buddyPatronymic;
        $this->buddyPosition = $buddyPosition;
        $this->buddyAge = $buddyAge;
        $this->buddyGender = $buddyGender;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBuddyPhoto()
    {
        return $this->buddyPhoto;
    }

    public function getBuddySurname()
    {
        return $this->buddySurname;
    }

    public function getBuddyName()
    {
        return $this->buddyName;
    }

    public function getBuddyPatronymic()
    {
        return $this->buddyPatronymic;
    }

    public function getBuddyId()
    {
        return $this->buddyId;
    }

    public function getBuddyPosition()
    {
        return $this->buddyPosition;
    }

    public function getBuddyAge()
    {
        return $this->buddyAge;
    }

    public function getBuddyGender()
    {
        return $this->buddyGender;
    }
}

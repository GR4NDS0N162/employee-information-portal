<?php

namespace User\Model;

class Profile
{
    /**
     * @var positive-int|null
     */
    private $id;

    /**
     * @var non-empty-string|null
     */
    private $password;

    /**
     * @var non-empty-string|null
     */
    private $surname;

    /**
     * @var non-empty-string|null
     */
    private $name;

    /**
     * @var non-empty-string|null
     */
    private $patronymic;

    /**
     * @var integer|null
     */
    private $gender;

    /**
     * @var non-empty-string|null
     */
    private $birthday;

    /**
     * @var non-empty-string|null
     */
    private $image;

    /**
     * @var non-empty-string|null
     */
    private $skype;

    /**
     * @param int|null $id
     * @param string|null $password
     * @param string|null $surname
     * @param string|null $name
     * @param string|null $patronymic
     * @param int|null $gender
     * @param string|null $birthday
     * @param string|null $image
     * @param string|null $skype
     */
    public function __construct(
        $id = null,
        $password = null,
        $surname = null,
        $name = null,
        $patronymic = null,
        $gender = null,
        $birthday = null,
        $image = null,
        $skype = null
    )
    {
        $this->id = $id;
        $this->password = $password;
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->skype = $skype;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @return int|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return string|null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getSkype()
    {
        return $this->skype;
    }

}

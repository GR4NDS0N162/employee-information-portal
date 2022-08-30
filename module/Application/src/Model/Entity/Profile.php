<?php

namespace Application\Model\Entity;

use InvalidArgumentException;
use Laminas\Db\ResultSet\HydratingResultSet;

class Profile
{
    protected $id;
    protected $password;
    protected $tempPassword;
    protected $tpCreatedAt;
    protected $surname;
    protected $name;
    protected $patronymic;
    protected $gender;
    protected $birthday;
    protected $image;
    protected $skype;
    protected $emails;
    protected $phones;

    public function __construct(
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
        $this->id = $id;
        $this->password = $password;
        $this->tempPassword = $tempPassword;
        $this->tpCreatedAt = $tpCreatedAt;
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

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getTempPassword()
    {
        return $this->tempPassword;
    }

    public function getTpCreatedAt()
    {
        return $this->tpCreatedAt;
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

    public function setEmails($emails)
    {
        if (is_array($emails) || $emails instanceof HydratingResultSet) {
            $this->emails = $emails;
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'Type of parameter $emails must be compatible with %2$s, %1$s used.',
                    get_class($emails),
                    implode(' or ', [
                        get_class(new Email()) . '[]',
                        get_class(new HydratingResultSet()),
                    ])
                )
            );
        }
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function setPhones($phones)
    {
        if (is_array($phones) || $phones instanceof HydratingResultSet) {
            $this->phones = $phones;
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'Type of parameter $phones must be compatible with %2$s, %1$s used.',
                    get_class($phones),
                    implode(' or ', [
                        get_class(new Phone()) . '[]',
                        get_class(new HydratingResultSet()),
                    ])
                )
            );
        }
    }
}
<?php

namespace Application\Model\Entity;

use InvalidArgumentException;
use Laminas\Db\ResultSet\HydratingResultSet;

class Profile
{
    protected ?int $id;
    protected string $password;
    protected ?string $tempPassword;
    protected ?string $tpCreatedAt;
    protected ?string $surname;
    protected ?string $name;
    protected ?string $patronymic;
    protected ?int $gender;
    protected ?string $birthday;
    protected ?string $image;
    protected ?string $skype;

    /**
     * @var Email[]|HydratingResultSet
     */
    protected $emails;

    /**
     * @var Phone[]|HydratingResultSet
     */
    protected $phones;

    public function __construct(
        string  $password = '',
                $emails = [],
                $phones = [],
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getTempPassword(): ?string
    {
        return $this->tempPassword;
    }

    public function getTpCreatedAt(): ?string
    {
        return $this->tpCreatedAt;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getSkype(): ?string
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

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setEmails($emails): void
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

    public function setPhones($phones): void
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
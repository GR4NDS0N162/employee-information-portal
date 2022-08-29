<?php

namespace Application\Model;

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
    protected array $emails;
    protected array $phones;

    public function __construct(
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

    public function getEmails(): array
    {
        return $this->emails;
    }

    public function getPhones(): array
    {
        return $this->phones;
    }
}
<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;

class UserInfo implements HydratorAwareInterface
{
    /**
     * @var string|null
     */
    protected $surname;
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $patronymic;
    /**
     * @var string
     */
    private $position;
    /**
     * @var int|null
     */
    private $age;
    /**
     * @var int|null
     */
    private $gender;
    /**
     * @var string|null
     */
    private $image;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param string|null $surname
     * @param string|null $name
     * @param string|null $patronymic
     * @param string      $position
     * @param int|null    $age
     * @param int|null    $gender
     * @param string|null $image
     */
    public function __construct(
        $surname = null,
        $name = null,
        $patronymic = null,
        $position = '',
        $age = null,
        $gender = null,
        $image = null
    ) {
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->position = $position;
        $this->age = $age;
        $this->gender = $gender;
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int|null
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return int|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int|null $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }
}
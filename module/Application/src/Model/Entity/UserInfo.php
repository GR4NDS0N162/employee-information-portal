<?php

namespace Application\Model\Entity;

class UserInfo
{
    /**
     * @var string|null
     */
    private $fullName;
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
     * @param string|null $fullName
     * @param string      $position
     * @param int|null    $age
     * @param int|null    $gender
     * @param string|null $image
     */
    public function __construct(
        $fullName = null,
        $position = '',
        $age = null,
        $gender = null,
        $image = null
    ) {
        $this->fullName = $fullName;
        $this->position = $position;
        $this->age = $age;
        $this->gender = $gender;
        $this->image = $image;
    }
}
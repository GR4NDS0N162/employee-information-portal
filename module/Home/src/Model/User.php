<?php

namespace Home\Model;

class User
{
    /**
     * @var positive-int|null
     */
    private $id;

    /**
     * @var non-empty-string
     */
    private $password;

    /**
     * @var non-empty-string
     */
    private $tempPassword;

    /**
     * @var positive-int
     */
    private $positionId;

    /**
     * @param string $password
     * @param string $tempPassword
     * @param int $positionId
     * @param int|null $id
     */
    public function __construct($password, $tempPassword, $positionId, $id = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->tempPassword = $tempPassword;
        $this->positionId = $positionId;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getTempPassword()
    {
        return $this->tempPassword;
    }

    /**
     * @return int
     */
    public function getPositionId()
    {
        return $this->positionId;
    }
}

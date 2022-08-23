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
     * @var non-empty-string|null
     */
    private $tempPassword;

    /**
     * @var non-empty-string|null
     */
    private $tpCreatedAt;

    /**
     * @var positive-int
     */
    private $positionId;

    /**
     * @param string $password
     * @param string|null $tempPassword
     * @param string|null $tpCreatedAt
     * @param int $positionId
     * @param int|null $id
     */
    public function __construct($password, $positionId, $tempPassword = null, $tpCreatedAt = null, $id = null)
    {
        $this->id = $id;
        $this->password = $password;
        $this->tempPassword = $tempPassword;
        $this->tpCreatedAt = $tpCreatedAt;
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
     * @return string|null
     */
    public function getTempPassword()
    {
        return $this->tempPassword;
    }

    /**
     * @return string|null
     */
    public function getTpCreatedAt()
    {
        return $this->tpCreatedAt;
    }

    /**
     * @return int
     */
    public function getPositionId()
    {
        return $this->positionId;
    }
}

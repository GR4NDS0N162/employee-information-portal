<?php

namespace Application\Model\Entity;

class ChangePassword
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private $currentPassword;
    /**
     * @var string
     */
    private $newPassword;
    /**
     * @var string
     */
    private $passwordCheck;

    /**
     * @param int|null $id
     * @param string   $currentPassword
     * @param string   $newPassword
     * @param string   $passwordCheck
     */
    public function __construct(
        $id = null,
        $currentPassword = '',
        $newPassword = '',
        $passwordCheck = ''
    ) {
        $this->id = $id;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->passwordCheck = $passwordCheck;
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
    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @return string
     */
    public function getPasswordCheck()
    {
        return $this->passwordCheck;
    }
}
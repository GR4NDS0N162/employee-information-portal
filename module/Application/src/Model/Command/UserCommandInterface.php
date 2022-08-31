<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;
use Application\Model\Entity\User;

interface UserCommandInterface
{
    /**
     * @param User  $user
     * @param Email $email
     *
     * @return void
     */
    public function insertUser($user, $email);

    /**
     * @param int    $userId
     * @param string $currentPassword
     * @param string $newPassword
     *
     * @return void
     */
    public function changePassword($userId, $currentPassword, $newPassword);

    /**
     * @param Email $email
     *
     * @return void
     */
    public function setTempPassword($email);

    /**
     * @param User $user
     *
     * @return void
     */
    public function updateUser($user);
}
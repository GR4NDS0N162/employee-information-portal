<?php

namespace Application\Model\Command;

use Application\Model\Entity\ChangePassword;
use Application\Model\Entity\Email;
use Application\Model\Entity\Profile;
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
     * @param ChangePassword $changePassword
     *
     * @return void
     */
    public function changePassword($changePassword);

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

    /**
     * @param Profile $profile
     *
     * @return void
     */
    public function updateProfile($profile);
}
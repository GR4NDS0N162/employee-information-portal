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
     * @return integer
     */
    public function insertUser(User $user, Email $email): int;

    /**
     * @param ChangePassword $changePassword
     *
     * @return void
     */
    public function changePassword(ChangePassword $changePassword);

    /**
     * @param Email|int $identifier
     *
     * @return void
     */
    public function setTempPassword($identifier);

    /**
     * @param User $user
     *
     * @return void
     */
    public function updateUser(User $user);

    /**
     * @param Profile $profile
     *
     * @return void
     */
    public function updateProfile(Profile $profile);
}
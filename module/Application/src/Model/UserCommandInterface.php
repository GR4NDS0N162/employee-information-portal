<?php

namespace Application\Model;

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
    public function insertUser(User $user, Email $email);

    /**
     * @param Email $email
     *
     * @return void
     */
    public function setTempPassword(Email $email);

    /**
     * @param User $user
     *
     * @return User
     */
    public function updateUser(User $user): User;
}
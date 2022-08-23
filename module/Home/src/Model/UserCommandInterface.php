<?php

namespace Home\Model;

interface UserCommandInterface
{
    /**
     * @param User $user
     * @param Email $email
     * @return User
     */
    public function insertUser($user, $email);
}

<?php

namespace Home\Model;

interface UserCommandInterface
{
    /**
     * @param User $user
     * @param Email $email
     */
    public function insertUser($user, $email);
}

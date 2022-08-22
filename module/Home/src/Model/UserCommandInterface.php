<?php

namespace Home\Model;

interface UserCommandInterface
{
    /**
     * @param User $user
     * @return User
     */
    public function insertUser($user);
}

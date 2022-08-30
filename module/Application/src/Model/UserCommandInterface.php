<?php

namespace Application\Model;

interface UserCommandInterface
{
    public function insertUser($user, $email);

    public function setTempPassword($email);

    public function updateUser($user);
}
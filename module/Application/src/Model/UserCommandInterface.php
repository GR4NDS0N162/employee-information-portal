<?php

namespace Application\Model;

use Application\Model\Entity\Email;
use Application\Model\Entity\User;

interface UserCommandInterface
{
    public function insertUser(User $user, Email $email);

    public function setTempPassword(Email $email);
}
<?php

namespace Application\Model;

use Application\Model\Entity\Email;
use Application\Model\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param integer|Email $identifier
     *
     * @return User
     */
    public function findUser($identifier): User;
}
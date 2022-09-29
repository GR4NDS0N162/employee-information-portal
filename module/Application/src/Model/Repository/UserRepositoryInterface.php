<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Application\Model\Entity\Profile;
use Application\Model\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param int|Email $identifier
     *
     * @return Profile
     */
    public function findProfile($identifier): Profile;

    /**
     * @param int|Email $identifier
     *
     * @return User
     */
    public function findUser($identifier): User;

    /**
     * @param array  $whereConfig
     * @param string $orderConfig
     *
     * @return User[]
     */
    public function findUsers(
        array  $whereConfig = [],
        string $orderConfig = 'fullname'
    ): array;
}
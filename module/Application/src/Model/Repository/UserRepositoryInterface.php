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
    public function findProfile($identifier);

    /**
     * @param int|Email $identifier
     *
     * @return User
     */
    public function findUser($identifier);

    /**
     * @param array  $whereConfig
     * @param string $orderConfig
     * @param bool   $limit
     * @param int    $page
     *
     * @return User[]
     */
    public function findUsers(
        array  $whereConfig = [],
        string $orderConfig = 'fullname',
        bool   $limit = false,
        int    $page = 1
    ): array;
}
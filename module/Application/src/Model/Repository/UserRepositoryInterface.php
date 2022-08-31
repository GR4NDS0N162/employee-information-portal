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
     * @param int $id
     *
     * @return User
     */
    public function findUserById($id);

    /**
     * @param Email $email
     *
     * @return User
     */
    public function findUserByEmail($email);
}
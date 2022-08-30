<?php

namespace Application\Model;

use Application\Model\Entity\User;
use Laminas\Form\Element\Email;

interface UserRepositoryInterface
{
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
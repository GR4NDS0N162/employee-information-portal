<?php

namespace Application\Model;

use Application\Model\Entity\Email;

interface EmailRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return Email[]
     */
    public function findEmailsOfUser($userId);

    /**
     * @param string $address
     *
     * @return Email
     */
    public function findEmail($address);
}
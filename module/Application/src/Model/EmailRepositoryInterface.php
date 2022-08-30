<?php

namespace Application\Model;

use Application\Model\Entity\Email;

interface EmailRepositoryInterface
{
    /**
     * @param integer $userId
     *
     * @return Email[]
     */
    public function findEmailsOfUser(int $userId);

    /**
     * @param string $address
     *
     * @return Email
     */
    public function findEmail(string $address);
}
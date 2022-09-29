<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Application\Model\Entity\Message;

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

    /**
     * @param Message[] $messages
     *
     * @return Email[]
     */
    public function generateMails(array $messages): array;
}
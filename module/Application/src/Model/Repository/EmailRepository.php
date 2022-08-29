<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;

class EmailRepository implements EmailRepositoryInterface
{
    public function findEmailsOfUser(int $userId): array
    {
        // TODO: Implement findEmailsOfUser() method.
    }
}
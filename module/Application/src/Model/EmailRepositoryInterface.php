<?php

namespace Application\Model;

interface EmailRepositoryInterface
{
    /**
     * @param integer $userId
     *
     * @return Email[]
     */
    public function findEmailsOfUser(int $userId): array;
}
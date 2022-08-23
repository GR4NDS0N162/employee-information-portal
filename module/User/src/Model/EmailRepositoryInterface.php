<?php

namespace User\Model;

interface EmailRepositoryInterface
{
    /**
     * @param $userId positive-int
     * @return Email[]
     */
    public function findEmailsOfUser($userId);
}

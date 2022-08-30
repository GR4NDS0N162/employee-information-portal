<?php

namespace Application\Model;

interface EmailRepositoryInterface
{
    public function findEmailsOfUser($userId);

    public function findEmail($address);
}
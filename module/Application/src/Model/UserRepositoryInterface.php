<?php

namespace Application\Model;

interface UserRepositoryInterface
{
    public function findUser($identifier);
}
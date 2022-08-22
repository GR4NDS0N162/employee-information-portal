<?php

namespace Home\Model;

interface UserRepositoryInterface
{
    /**
     * @param $id positive-int
     * @return User
     */
    public function findUser($id);
}
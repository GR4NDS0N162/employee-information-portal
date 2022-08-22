<?php

namespace User\Model;

interface ListRepositoryInterface
{
    public function findItemsOfUser($userId, $table);
}

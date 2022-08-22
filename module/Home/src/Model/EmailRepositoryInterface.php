<?php

namespace Home\Model;

interface EmailRepositoryInterface
{
    /**
     * @param $address non-empty-string
     * @return Email
     */
    public function findEmail($address);
}

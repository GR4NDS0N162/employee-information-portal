<?php

namespace User\Model;

interface PhoneRepositoryInterface
{
    /**
     * @param $userId positive-int
     * @return Phone[]
     */
    public function findPhonesOfUser($userId);
}

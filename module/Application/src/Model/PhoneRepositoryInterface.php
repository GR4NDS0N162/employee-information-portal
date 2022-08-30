<?php

namespace Application\Model;

interface PhoneRepositoryInterface
{
    public function findPhonesOfUser($userId);
}
<?php

namespace Application\Model;

interface StatusRepositoryInterface
{
    public function findAllStatuses();

    public function findStatusesOfUser($userId);

    public function generateStatusMapOfUser($userId);
}
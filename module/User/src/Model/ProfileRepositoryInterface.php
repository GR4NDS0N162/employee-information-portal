<?php

namespace User\Model;

interface ProfileRepositoryInterface
{
    /**
     * @param $id positive-int
     * @return Profile
     */
    public function findProfile($id);
}

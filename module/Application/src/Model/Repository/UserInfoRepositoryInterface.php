<?php

namespace Application\Model\Repository;

use Application\Model\Entity\UserInfo;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Predicate\PredicateInterface;
use Laminas\Db\Sql\Where;

interface UserInfoRepositoryInterface
{
    /**
     * @param Where|Closure|string|array|PredicateInterface $where
     * @param string|array|Expression                       $order
     *
     * @return UserInfo[]
     */
    public function findUsersInfo($where = [], $order = []);
}
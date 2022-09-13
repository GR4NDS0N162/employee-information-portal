<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Application\Model\Entity\Profile;
use Application\Model\Entity\User;
use Laminas\Db\Sql\Expression;
use Laminas\Db\Sql\Predicate\PredicateInterface;
use Laminas\Db\Sql\Where;

interface UserRepositoryInterface
{
    /**
     * @param int|Email $identifier
     *
     * @return Profile
     */
    public function findProfile($identifier);

    /**
     * @param int|Email $identifier
     *
     * @return User
     */
    public function findUser($identifier);

    /**
     * @param Where|Closure|string|array|PredicateInterface $where
     * @param string|array|Expression                       $order
     * @param bool                                          $limit
     * @param int                                           $page
     *
     * @return User[]
     */
    public function findUsers(
        $where = ['s.name = ?' => 'active'],
        $order = [],
        $limit = true,
        $page = 1
    );
}
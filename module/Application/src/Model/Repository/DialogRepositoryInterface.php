<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Dialog;
use Laminas\Db\Sql\Predicate\PredicateInterface;
use Laminas\Db\Sql\Where;

interface DialogRepositoryInterface
{
    /**
     * @param int                                           $userId
     * @param Where|Closure|string|array|PredicateInterface $where
     *
     * @return Dialog[]
     */
    public function getDialogList($userId, $where = []);

    /**
     * @param int $userId
     * @param int $buddyId
     *
     * @return int
     */
    public function getDialogId($userId, $buddyId);
}
<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Message;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Predicate\PredicateInterface;
use Laminas\Db\Sql\Where;

interface MessageRepositoryInterface
{
    /**
     * @param int                                           $dialogId
     * @param Where|Closure|string|array|PredicateInterface $where
     * @param string|array|Expression                       $order
     * @param int|null                                      $limit
     * @param int|null                                      $offset
     *
     * @return Message[]
     */
    public function findMessagesOfDialog(
        $dialogId,
        $where = [],
        $order = [],
        $limit = null,
        $offset = null
    );
}
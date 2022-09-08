<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Message;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorAwareInterface;

class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var Message|HydratorAwareInterface
     */
    private $prototype;

    /**
     * @param AdapterInterface               $db
     * @param Message|HydratorAwareInterface $prototype
     */
    public function __construct(
        $db,
        $prototype
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
    }

    public function findMessagesOfDialog(
        $dialogId,
        $where = [],
        $limit = null,
        $offset = null
    ) {
        // TODO: Implement findMessagesOfDialog() method.
    }
}
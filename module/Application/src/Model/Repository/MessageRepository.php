<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Message;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
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
    )
    {
        $select = new Select('message');
        $select->columns([
            'id',
            'userId'    => 'user_id',
            'dialogId'  => 'dialog_id',
            'createdAt' => 'created_at',
            'openedAt'  => 'opened_at',
            'content',
        ]);
        $select->where(['dialog_id = ?' => $dialogId]);
        $select->join('content', 'id = message_id');
        $select->order(['created_at DESC']);

        /** @var Message[] $messages */
        $messages = Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );

        return $messages;
    }
}
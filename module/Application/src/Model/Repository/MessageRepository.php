<?php

namespace Application\Model\Repository;

use Application\Controller\MessengerController;
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
        $lastMessageId = null,
        $maxLoadCount = MessengerController::maxLoadCount
    ) {
        $select = new Select(['mes' => 'message']);
        $select->columns([
            'id'        => 'mes.id',
            'userId'    => 'mes.user_id',
            'dialogId'  => 'mes.dialog_id',
            'createdAt' => 'mes.created_at',
            'openedAt'  => 'mes.opened_at',
            'content'   => 'c.content',
        ], false);
        $select->join(
            ['c' => 'content'],
            'mes.id = c.message_id',
            [],
        );

        $where = ['mes.dialog_id = ?' => $dialogId];
        if (isset($lastMessageId)) {
            $where['mes.id < ?'] = $lastMessageId;
        }
        $select->where($where);

        $select->order(['mes.created_at DESC', 'mes.id DESC']);
        $select->limit($maxLoadCount);

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
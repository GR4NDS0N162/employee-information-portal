<?php

namespace Application\Model\Repository;

use Application\Controller\MessengerController;
use Application\Model\Entity\Message;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;

class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;
    /**
     * @var Message
     */
    private Message $prototype;

    /**
     * @param AdapterInterface $db
     */
    public function __construct(
        AdapterInterface $db
    ) {
        $this->db = $db;
        $this->prototype = new Message();
    }

    public function findMessagesOfDialog(
        int  $dialogId,
        ?int $lastMessageId = null,
        int  $maxMessageCount = MessengerController::MAX_MESSAGE_COUNT
    ): array {
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
        $select->limit($maxMessageCount);

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
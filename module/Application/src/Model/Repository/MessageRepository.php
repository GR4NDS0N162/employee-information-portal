<?php

namespace Application\Model\Repository;

use Application\Controller\MessengerController;
use Application\Model\Entity\Message;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

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
        $dialogId,
        $lastMessageId = null,
        $maxLoadCount = MessengerController::MAX_MESSAGE_COUNT
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

    public function getUnreadMessages()
    {
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

        $where = new Where();
        $where->isNull('mes.opened_at');
        $where->greaterThanOrEqualTo(new Expression('TIMESTAMPDIFF(MINUTE, mes.created_at, NOW())'), 15);

        $select->where($where);

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
<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Insert;

class MessageCommand implements MessageCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @param AdapterInterface $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function sendMessage($message)
    {
        $insert = new Insert('message');
        $insert->values([
            'user_id'    => $message->getUserId(),
            'dialog_id'  => $message->getDialogId(),
            'created_at' => $message->getCreatedAt(),
        ]);
        $messageId = Executer::executeSql($insert, $this->db);

        $insert = new Insert('content');
        $insert->values([
            'message_id' => $messageId,
            'content'    => $message->getContent(),
        ]);
        Executer::executeSql($insert, $this->db);
    }

    public function readBy($userId, $messageList)
    {
        // TODO: Implement readBy() method.
    }
}
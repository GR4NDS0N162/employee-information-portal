<?php

namespace Application\Model\Command;

use Application\Model\Entity\Message;
use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;

class MessageCommand implements MessageCommandInterface
{
    private AdapterInterface $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function sendMessage(Message $message)
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

    public function readBy(int $userId, array $messageList): array
    {
        if (empty($messageList)) {
            return $messageList;
        }

        $currentDateTime = date('Y-m-d H:i:s');
        foreach ($messageList as $message) {
            if (
                is_null($message->getOpenedAt())
                && $message->getUserId() != $userId
            ) {
                $message->setOpenedAt($currentDateTime);
            }
        }
        $dialogId = $message->getDialogId();

        $update = new Update('message');
        $update->set([
            'opened_at' => $currentDateTime,
        ]);
        $update->where([
            'dialog_id = ' . $dialogId,
            'opened_at IS NULL',
            'user_id != ' . $userId,
        ]);

        Executer::executeSql($update, $this->db);

        return $messageList;
    }
}
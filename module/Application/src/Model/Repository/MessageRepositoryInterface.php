<?php

namespace Application\Model\Repository;

use Application\Controller\MessengerController;
use Application\Model\Entity\Message;

interface MessageRepositoryInterface
{
    /**
     * @param int      $dialogId
     * @param int|null $lastMessageId
     * @param int      $maxLoadCount
     *
     * @return Message[]
     */
    public function findMessagesOfDialog(
        $dialogId,
        $lastMessageId = null,
        $maxLoadCount = MessengerController::MAX_MESSAGE_COUNT
    );
}
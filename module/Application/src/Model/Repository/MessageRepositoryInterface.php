<?php

namespace Application\Model\Repository;

use Application\Controller\MessengerController;
use Application\Model\Entity\Message;

interface MessageRepositoryInterface
{
    /**
     * @param int      $dialogId
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return Message[]
     */
    public function findMessagesOfDialog(
        $dialogId,
        $lastMessageId = null,
        $maxLoadCount = MessengerController::maxLoadCount
    );
}
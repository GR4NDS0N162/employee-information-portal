<?php

namespace Application\Model\Command;

use Application\Model\Entity\Message;

interface MessageCommandInterface
{
    /**
     * @param Message $message
     *
     * @return void
     */
    public function sendMessage($message);
}
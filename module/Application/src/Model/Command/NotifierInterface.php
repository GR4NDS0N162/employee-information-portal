<?php

namespace Application\Model\Command;

use Application\Model\Entity\Message;

interface NotifierInterface
{
    /**
     * @param Message[] $messages
     *
     * @return void
     */
    public function sendEmails(array $messages);
}
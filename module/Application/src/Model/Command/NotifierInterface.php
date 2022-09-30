<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;

interface NotifierInterface
{
    /**
     * @param Email[] $mailsInfo
     *
     * @return void
     */
    public function sendEmails(array $mailsInfo);
}
<?php

namespace Application\Model\Command;

use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;

class Notifier implements NotifierInterface
{
    public function sendEmails(array $mailsInfo)
    {
        $transport = new Sendmail();

        foreach ($mailsInfo as $email) {
            $message = new Message();
            $message->setBody(
                'You have an unread message from a user with an ID '
                . $email->getUserId()
            );
            $message->setFrom('infoportal@corp.com', "Employee Information Portal");
            $message->addTo($email->getAddress(), 'Your name');
            $message->setSubject('Unread message');

            $transport->send($message);
        }
    }
}
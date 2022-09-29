<?php

namespace Application\Model\Command;

use Application\Model\Entity\Email;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;

class Notifier implements NotifierInterface
{
    private AdapterInterface $db;
    private Email $prototype;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
        $this->prototype = new Email();
    }

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
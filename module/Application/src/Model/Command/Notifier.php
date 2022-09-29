<?php

namespace Application\Model\Command;

use Laminas\Db\Adapter\AdapterInterface;

class Notifier implements NotifierInterface
{
    private AdapterInterface $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function sendEmails(array $messages)
    {
        // TODO: Implement sendEmails() method.
    }
}
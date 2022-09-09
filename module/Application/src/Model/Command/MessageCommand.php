<?php

namespace Application\Model\Command;

use Laminas\Db\Adapter\AdapterInterface;

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
        // TODO: Implement sendMessage() method.
    }
}
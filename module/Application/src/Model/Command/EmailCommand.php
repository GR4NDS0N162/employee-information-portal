<?php

namespace Application\Model\Command;

use Laminas\Db\Adapter\AdapterInterface;

class EmailCommand implements EmailCommandInterface
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

    public function updateEmails($oldList, $newList)
    {
        // TODO: Implement updateEmails() method.
    }

    public function deleteEmailByAddress($address)
    {
        // TODO: Implement deleteEmailByAddress() method.
    }

    public function addEmail($email)
    {
        // TODO: Implement addEmail() method.
    }
}
<?php

namespace Application\Model\Command;

use Laminas\Db\Adapter\AdapterInterface;

class EmailCommand implements EmailCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;

    /**
     * @param AdapterInterface $db
     */
    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function updateEmails($userId, $oldList, $newList)
    {
        $oldAddressList = array_column($oldList, 'address');
        $newAddressList = array_column($newList, 'address');

        $toDelete = array_diff($oldAddressList, $newAddressList);
        $toAdd = array_diff($newAddressList, $oldAddressList);
    }
}
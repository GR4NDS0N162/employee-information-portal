<?php

namespace User\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class ListRepository implements ListRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var ListItem
     */
    private $listItemPrototype;

    /**
     * @param AdapterInterface $db
     * @param HydratorInterface $hydrator
     * @param ListItem $listItemPrototype
     */
    public function __construct($db, $hydrator, $listItemPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->listItemPrototype = $listItemPrototype;
    }

    public function findItemsOfUser($userId, $table)
    {
        // TODO: Implement findItemsOfUser() method.
    }
}

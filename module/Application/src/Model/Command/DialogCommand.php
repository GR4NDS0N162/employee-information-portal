<?php

namespace Application\Model\Command;

use Laminas\Db\Adapter\AdapterInterface;

class DialogCommand implements DialogCommandInterface
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
}
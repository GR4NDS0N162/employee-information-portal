<?php

namespace Application\Model\Command;

use Application\Model\Repository\PositionRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;

class PositionCommand implements PositionCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    /**
     * @param AdapterInterface            $db
     * @param PositionRepositoryInterface $positionRepository
     */
    public function __construct($db, $positionRepository)
    {
        $this->db = $db;
        $this->positionRepository = $positionRepository;
    }
}
<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Application\Model\Repository\PositionRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;

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

    public function updatePositions($positionList)
    {
        // TODO: Implement updatePositions() method.
    }

    public function deletePositionById($id)
    {
        $delete = new Delete('position');
        $delete->where(['id = ?' => $id]);

        Executer::executeSql($delete, $this->db);
    }
}
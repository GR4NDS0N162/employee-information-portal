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
        $oldList = $this->positionRepository->findAllPositions();
        $newList = $positionList->getList();

        $oldIdList = array_column($oldList, 'id');
        $newIdList = array_column($newList, 'id');

        $deleteList = [];
        foreach ($oldList as $position) {
            if (!in_array($position->getId(), $newIdList)) {
                $deleteList[] = $position;
            }
        }

        $addList = [];
        $editList = [];
        foreach ($newList as $position) {
            if (in_array($position->getId(), $oldIdList)) {
                $editList[] = $position;
            } else {
                $addList[] = $position;
            }
        }
    }

    public function deletePositionById($id)
    {
        $delete = new Delete('position');
        $delete->where(['id = ?' => $id]);

        Executer::executeSql($delete, $this->db);
    }
}
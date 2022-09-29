<?php

namespace Application\Model\Command;

use Application\Model\Entity\Position;
use Application\Model\Entity\PositionList;
use Application\Model\Executer;
use Application\Model\Repository\PositionRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;

class PositionCommand implements PositionCommandInterface
{
    private AdapterInterface $db;
    private PositionRepositoryInterface $positionRepository;

    public function __construct(
        AdapterInterface            $db,
        PositionRepositoryInterface $positionRepository
    ) {
        $this->db = $db;
        $this->positionRepository = $positionRepository;
    }

    public function updatePositions(PositionList $positionList)
    {
        $oldList = $this->positionRepository->findAllPositions();
        $newList = $positionList->getList();

        $oldIdList = array_column($oldList, 'id');
        $newIdList = array_column($newList, 'id');

        foreach ($oldList as $position) {
            if (!in_array($position->getId(), $newIdList)) {
                $this->deletePositionById($position->getId());
            }
        }

        foreach ($newList as $position) {
            if (in_array($position->getId(), $oldIdList)) {
                $this->updatePosition($position);
            } else {
                $this->addPosition($position);
            }
        }
    }

    public function deletePositionById(int $id)
    {
        $delete = new Delete('position');
        $delete->where(['id = ?' => $id]);

        Executer::executeSql($delete, $this->db);
    }

    public function updatePosition(Position $position)
    {
        $update = new Update('position');
        $update->set(['name' => $position->getName()]);
        $update->where(['id' => $position->getId()]);

        Executer::executeSql($update, $this->db);
    }

    public function addPosition(Position $position)
    {
        $insert = new Insert('position');
        $insert->values(['name' => $position->getName()]);

        Executer::executeSql($insert, $this->db);
    }
}
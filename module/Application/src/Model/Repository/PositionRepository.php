<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Position;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Hydrator\HydratorInterface;

class PositionRepository implements PositionRepositoryInterface
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
     * @var Position
     */
    private $prototype;

    /**
     * @param AdapterInterface  $db
     * @param HydratorInterface $hydrator
     * @param Position          $prototype
     */
    public function __construct($db, $hydrator, $prototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
    }

    public function findAllPositions()
    {
        $select = new Select('position');
        $select->columns([
            'id',
            'name',
        ]);

        return Extracter::extractValues($select, $this->db, $this->hydrator, $this->prototype);
    }
}
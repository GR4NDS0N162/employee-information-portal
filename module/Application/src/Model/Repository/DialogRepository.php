<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Dialog;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorAwareInterface;

class DialogRepository implements DialogRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var Dialog|HydratorAwareInterface
     */
    private $prototype;

    /**
     * @param AdapterInterface              $db
     * @param Dialog|HydratorAwareInterface $prototype
     */
    public function __construct(
        $db,
        $prototype
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
    }

    public function getDialogList($userId)
    {
        // TODO: Implement getDialogList() method.
    }
}
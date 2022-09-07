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
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @param AdapterInterface              $db
     * @param Dialog|HydratorAwareInterface $prototype
     * @param UserRepositoryInterface       $userRepository
     */
    public function __construct(
        $db,
        $prototype,
        $userRepository
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
        $this->userRepository = $userRepository;
    }

    public function getDialogList($userId)
    {
        // TODO: Implement getDialogList() method.
    }
}
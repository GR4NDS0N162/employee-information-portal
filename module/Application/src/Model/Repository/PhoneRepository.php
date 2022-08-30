<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Phone;
use Application\Model\PhoneRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorInterface;

class PhoneRepository implements PhoneRepositoryInterface
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
     * @var Phone
     */
    private $phonePrototype;

    public function __construct(
        AdapterInterface  $db,
        HydratorInterface $hydrator,
        Phone             $phonePrototype
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->phonePrototype = $phonePrototype;
    }

    public function findPhonesOfUser(int $userId)
    {
        // TODO: Implement findPhonesOfUser() method.
    }
}
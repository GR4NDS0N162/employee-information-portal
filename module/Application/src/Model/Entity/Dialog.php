<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;

class Dialog implements HydratorAwareInterface
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int
     */
    private $buddyId;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param int|null $id
     * @param int      $buddyId
     */
    public function __construct(
        $buddyId = 0,
        $id = null
    ) {
        $this->id = $id;
        $this->buddyId = $buddyId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBuddyId($buddyId)
    {
        $this->buddyId = $buddyId;
    }

    public function getBuddyId()
    {
        return $this->buddyId;
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }
}
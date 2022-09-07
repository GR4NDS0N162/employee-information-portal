<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;

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

        $this->hydrator = new ClassMethodsHydrator(false);
        $this->hydrator->addStrategy('id', new NullableStrategy(ScalarTypeStrategy::createToInt(), true));
        $this->hydrator->addStrategy('buddyId', ScalarTypeStrategy::createToInt());
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop): bool
    {
        return isset($this->$prop);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBuddyId()
    {
        return $this->buddyId;
    }

    public function setBuddyId($buddyId)
    {
        $this->buddyId = $buddyId;
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
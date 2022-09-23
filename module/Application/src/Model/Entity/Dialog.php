<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;

class Dialog implements HydratorAwareInterface
{
    private ?int $id;
    private int $buddyId;
    private HydratorInterface $hydrator;

    public function __construct(
        int $buddyId = 0,
        ?int $id = null
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getBuddyId(): int
    {
        return $this->buddyId;
    }

    public function setBuddyId(int $buddyId)
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
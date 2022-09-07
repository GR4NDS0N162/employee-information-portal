<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;

class Dialog implements HydratorAwareInterface
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }
}
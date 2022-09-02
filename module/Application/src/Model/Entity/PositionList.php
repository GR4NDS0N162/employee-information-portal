<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\CollectionStrategy;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\IsCountable;

class PositionList implements InputFilterAwareInterface, HydratorAwareInterface
{
    /**
     * @var Position[]
     */
    private $list;
    /**
     * @var InputFilterInterface
     */
    private $inputFilter;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param Position[] $list
     */
    public function __construct($list = [])
    {
        $this->list = $list;

        $this->inputFilter = new InputFilter();
        $this->inputFilter->add([
            'name'       => 'list',
            'required'   => false,
            'validators' => [
                [
                    'name' => IsCountable::class,
                ],
            ],
        ]);

        $this->hydrator = new ClassMethodsHydrator(false);
        $this->hydrator->addStrategy(
            'list',
            new CollectionStrategy(
                (new Position())->getHydrator(),
                Position::class
            )
        );
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    public function setInputFilter($inputFilter)
    {
        throw new DomainException(
            sprintf(
                '%s does not allow injection of an alternate input filter',
                __CLASS__
            )
        );
    }

    /**
     * @return Position[]
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param Position[] $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }
}
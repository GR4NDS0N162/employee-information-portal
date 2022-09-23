<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\IsCountable;

class PositionList implements InputFilterAwareInterface, HydratorAwareInterface
{
    /**
     * @var Position[]
     */
    private array $list;
    private InputFilterInterface $inputFilter;
    private HydratorInterface $hydrator;

    /**
     * @param Position[] $list
     */
    public function __construct(array $list = [])
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
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }

    public function getInputFilter():InputFilterInterface
    {
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return Position[]
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @param Position[] $list
     */
    public function setList(array $list)
    {
        $this->list = $list;
    }
}
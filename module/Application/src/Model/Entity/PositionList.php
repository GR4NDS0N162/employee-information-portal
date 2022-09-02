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
        $this->inputFilter = $inputFilter;
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
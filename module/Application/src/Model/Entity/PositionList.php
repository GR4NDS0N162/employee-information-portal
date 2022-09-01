<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\IsCountable;

class PositionList implements InputFilterAwareInterface
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
     * @param Position[] $list
     */
    public function __construct($list = [])
    {
        $this->list = $list;
        $this->inputFilter = $this->getInputFilter();
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

    public function getInputFilter()
    {
        if (isset($this->inputFilter)) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name'       => 'list',
            'validators' => [
                ['name' => IsCountable::class,],
            ],
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(
            sprintf(
                '%s does not allow injection of an alternate input filter',
                __CLASS__
            )
        );
    }
}
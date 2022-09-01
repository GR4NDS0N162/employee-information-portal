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
    private array $list;
    /**
     * @var InputFilterInterface
     */
    private InputFilterInterface $inputFilter;

    /**
     * @param Position[] $list
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
        $this->inputFilter = $this->getInputFilter();
    }

    public function getInputFilter(): InputFilterInterface
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

    public function setInputFilter(InputFilterInterface $inputFilter): InputFilterAwareInterface
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
<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\StringLength;

class Position implements InputFilterAwareInterface
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var InputFilterInterface
     */
    private $inputFilter;

    /**
     * @param string   $name
     * @param int|null $id
     */
    public function __construct($name = '', $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->inputFilter = $this->getInputFilter();
    }

    public function getInputFilter()
    {
        if (isset($this->inputFilter)) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name'       => 'id',
            'filters'    => [
                ['name' => ToInt::class],
            ],
            'validators' => [
                [
                    'name'    => GreaterThan::class,
                    'options' => [
                        'min' => 0,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'name',
            'required'   => true,
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 100,
                    ],
                ],
            ],
        ]);

        $this->inputFilter = $inputFilter;
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

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop): bool
    {
        return isset($this->$prop);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
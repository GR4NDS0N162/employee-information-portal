<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class Email implements InputFilterAwareInterface
{
    /**
     * @var string
     */
    private string $address;
    /**
     * @var int|null
     */
    private ?int $userId;
    /**
     * @var InputFilterInterface
     */
    private InputFilterInterface $inputFilter;

    /**
     * @param string   $address
     * @param int|null $userId
     */
    public function __construct(
        $address = '',
        $userId = null
    ) {
        $this->address = $address;
        $this->userId = $userId;
        $this->inputFilter = $this->getInputFilter();
    }

    public function getInputFilter()
    {
        if (isset($this->inputFilter)) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name'       => 'userId',
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
            'name'       => 'address',
            'required'   => true,
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 320,
                    ],
                ],
                [
                    'name'    => Regex::class,
                    'options' => [
                        'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',
                    ],
                ],
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

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
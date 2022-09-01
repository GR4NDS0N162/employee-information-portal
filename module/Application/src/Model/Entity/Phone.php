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

class Phone implements InputFilterAwareInterface
{
    /**
     * @var string
     */
    private string $number;
    /**
     * @var int|null
     */
    private ?int $userId;
    /**
     * @var InputFilterInterface
     */
    private InputFilterInterface $inputFilter;

    /**
     * @param string   $number
     * @param int|null $userId
     */
    public function __construct(
        $number = '',
        $userId = null
    ) {
        $this->number = $number;
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
            'name'       => 'number',
            'required'   => true,
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 13,
                    ],
                ],
                [
                    'name'    => Regex::class,
                    'options' => [
                        'pattern' => '/^\+7[0-9]{10}$/',
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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
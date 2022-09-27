<?php

namespace Application\Model\Entity;

use Laminas\Filter\ToInt;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class Phone implements InputFilterAwareInterface, HydratorAwareInterface
{
    private string $number;
    private ?int $userId;
    private InputFilterInterface $inputFilter;
    private HydratorInterface $hydrator;

    public function __construct(
        string $number = '',
        ?int   $userId = null
    ) {
        $this->number = $number;
        $this->userId = $userId;

        $this->inputFilter = new InputFilter();
        $this->inputFilter->add([
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
        $this->inputFilter->add([
            'name'       => 'userId',
            'required'   => false,
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

        $this->hydrator = new ClassMethodsHydrator(false);
        $this->hydrator->addStrategy('number', ScalarTypeStrategy::createToString());
        $this->hydrator->addStrategy('userId', new NullableStrategy(ScalarTypeStrategy::createToInt(), true));
    }

    public function toArray()
    {
        return [
            'number' => $this->number,
            'userId' => $this->userId,
        ];
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop): bool
    {
        return isset($this->$prop);
    }

    public function getInputFilter(): InputFilterInterface
    {
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number)
    {
        $this->number = $number;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId)
    {
        $this->userId = $userId;
    }
}
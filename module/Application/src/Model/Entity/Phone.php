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
    /**
     * @var string
     */
    private $number;
    /**
     * @var int|null
     */
    private $userId;
    /**
     * @var InputFilterInterface
     */
    private $inputFilter;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

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

    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    public function setInputFilter($inputFilter)
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

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\GreaterThan;

class UserStatus implements InputFilterAwareInterface
{
    /**
     * @var int|null
     */
    private $userId;
    /**
     * @var int
     */
    private $statusId;
    /**
     * @var InputFilter
     */
    private $inputFilter;

    /**
     * @param int|null $userId
     * @param int      $statusId
     */
    public function __construct(
        $statusId = 0,
        $userId = null
    ) {
        $this->userId = $userId;
        $this->statusId = $statusId;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
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

    public function getInputFilter()
    {
        if ($this->inputFilter) {
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
            'name'       => 'statusId',
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

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
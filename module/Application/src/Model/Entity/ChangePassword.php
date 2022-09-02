<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\Filter;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator;

class ChangePassword implements InputFilterAwareInterface, HydratorAwareInterface
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private $currentPassword;
    /**
     * @var string
     */
    private $newPassword;
    /**
     * @var string
     */
    private $passwordCheck;
    /**
     * @var InputFilterInterface
     */
    private $inputFilter;
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param int|null $id
     * @param string   $currentPassword
     * @param string   $newPassword
     * @param string   $passwordCheck
     */
    public function __construct(
        $id = null,
        $currentPassword = '',
        $newPassword = '',
        $passwordCheck = ''
    ) {
        $this->id = $id;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->passwordCheck = $passwordCheck;

        $this->hydrator = new ClassMethodsHydrator(false);
        $this->hydrator->addStrategy('id', new NullableStrategy(ScalarTypeStrategy::createToInt(), true));
        $this->hydrator->addStrategy('currentPassword', ScalarTypeStrategy::createToString());
        $this->hydrator->addStrategy('newPassword', ScalarTypeStrategy::createToString());
        $this->hydrator->addStrategy('passwordCheck', ScalarTypeStrategy::createToString());

        $this->inputFilter = new InputFilter();
        $this->inputFilter->add([
            'name'       => 'id',
            'required'   => true,
            'filters'    => [
                ['name' => Filter\ToInt::class],
            ],
            'validators' => [
            ],
        ]);
        $this->inputFilter->add([
            'name'       => 'currentPassword',
            'required'   => true,
            'filters'    => [
            ],
            'validators' => [
            ],
        ]);
        $this->inputFilter->add([
            'name'       => 'newPassword',
            'required'   => true,
            'filters'    => [
            ],
            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 8,
                        'max'      => 32,
                    ],
                ],
                [
                    'name'    => Validator\Regex::class,
                    'options' => [
                        'pattern' => '/^'
                            . '(?=.*?[а-яa-z])'
                            . '(?=.*?[А-ЯA-Z])'
                            . '(?=.*?[0-9])'
                            . '(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])'
                            . '[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*'
                            . '$/',
                    ],
                ],
            ],
        ]);
        $this->inputFilter->add([
            'name'       => 'passwordCheck',
            'required'   => true,
            'filters'    => [
            ],
            'validators' => [
                [
                    'name'    => Validator\Identical::class,
                    'options' => [
                        'token' => 'newPassword',
                    ],
                ],
            ],
        ]);
    }

    public function getInputFilter()
    {
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
    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    /**
     * @param string $currentPassword
     */
    public function setCurrentPassword($currentPassword)
    {
        $this->currentPassword = $currentPassword;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param string $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * @return string
     */
    public function getPasswordCheck()
    {
        return $this->passwordCheck;
    }

    /**
     * @param string $passwordCheck
     */
    public function setPasswordCheck($passwordCheck)
    {
        $this->passwordCheck = $passwordCheck;
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }
}
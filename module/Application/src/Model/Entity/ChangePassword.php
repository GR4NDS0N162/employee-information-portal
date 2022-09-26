<?php

namespace Application\Model\Entity;

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
    private ?int $id;
    private string $currentPassword;
    private string $newPassword;
    private string $passwordCheck;
    private InputFilterInterface $inputFilter;
    private HydratorInterface $hydrator;

    public function __construct(
        ?int   $id = null,
        string $currentPassword = '',
        string $newPassword = '',
        string $passwordCheck = ''
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

    public function getInputFilter(): InputFilterInterface
    {
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function setCurrentPassword(string $currentPassword)
    {
        $this->currentPassword = $currentPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function getPasswordCheck(): string
    {
        return $this->passwordCheck;
    }

    public function setPasswordCheck(string $passwordCheck)
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
<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class ChangePassword implements InputFilterAwareInterface
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
            ],
            'validators' => [
            ],
        ]);

        $inputFilter->add([
            'name'       => 'currentPassword',
            'filters'    => [
            ],
            'validators' => [
            ],
        ]);

        $inputFilter->add([
            'name'       => 'newPassword',
            'filters'    => [
            ],
            'validators' => [
            ],
        ]);

        $inputFilter->add([
            'name'       => 'passwordCheck',
            'filters'    => [
            ],
            'validators' => [
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
}
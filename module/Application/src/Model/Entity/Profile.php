<?php

namespace Application\Model\Entity;

use DomainException;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\Between;
use Laminas\Validator\Date;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class Profile implements InputFilterAwareInterface
{
    /**
     * @var int|null
     */
    protected ?int $id;
    /**
     * @var string
     */
    protected string $password;
    /**
     * @var string|null
     */
    protected ?string $tempPassword;
    /**
     * @var string|null
     */
    protected ?string $tpCreatedAt;
    /**
     * @var string|null
     */
    protected ?string $surname;
    /**
     * @var string|null
     */
    protected ?string $name;
    /**
     * @var string|null
     */
    protected ?string $patronymic;
    /**
     * @var int|null
     */
    protected ?int $gender;
    /**
     * @var string|null
     */
    protected ?string $birthday;
    /**
     * @var string|null
     */
    protected ?string $image;
    /**
     * @var string|null
     */
    protected ?string $skype;
    /**
     * @var Email[]
     */
    protected array $emails;
    /**
     * @var Phone[]
     */
    protected array $phones;
    /**
     * @var InputFilterInterface
     */
    private InputFilterInterface $inputFilter;

    /**
     * @param string      $password
     * @param Email[]     $emails
     * @param Phone[]     $phones
     * @param string|null $tempPassword
     * @param string|null $tpCreatedAt
     * @param string|null $surname
     * @param string|null $name
     * @param string|null $patronymic
     * @param int|null    $gender
     * @param string|null $birthday
     * @param string|null $image
     * @param string|null $skype
     * @param int|null    $id
     */
    public function __construct(
        $password = '',
        $emails = [],
        $phones = [],
        $tempPassword = null,
        $tpCreatedAt = null,
        $surname = null,
        $name = null,
        $patronymic = null,
        $gender = null,
        $birthday = null,
        $image = null,
        $skype = null,
        $id = null
    ) {
        $this->id = $id;
        $this->password = $password;
        $this->tempPassword = $tempPassword;
        $this->tpCreatedAt = $tpCreatedAt;
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->skype = $skype;
        $this->emails = $emails;
        $this->phones = $phones;
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
            'required'   => true,
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
            'name'       => 'password',
            'required'   => true,
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 8,
                        'max'      => 32,
                    ],
                ],
                [
                    'name'    => Regex::class,
                    'options' => [
                        'pattern' => '/^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$/',
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'tempPassword',
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 8,
                        'max'      => 32,
                    ],
                ],
                [
                    'name'    => Regex::class,
                    'options' => [
                        'pattern' => '/^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$/',
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'tpCreatedAt',
            'validators' => [
                [
                    'name'    => Date::class,
                    'options' => [
                        'format' => 'Y-m-d H:i:s',
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'surname',
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 60,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'name',
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 60,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'patronymic',
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 60,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'gender',
            'filters'    => [
                ['name' => ToInt::class],
            ],
            'validators' => [
                [
                    'name'    => Between::class,
                    'options' => [
                        'min'       => -127,
                        'max'       => 128,
                        'inclusive' => true,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'birthday',
            'validators' => [
                [
                    'name'    => Date::class,
                    'options' => [
                        'format' => 'Y-m-d',
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'image',
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 255,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'skype',
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max'      => 32,
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
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getTempPassword()
    {
        return $this->tempPassword;
    }

    /**
     * @return string|null
     */
    public function getTpCreatedAt()
    {
        return $this->tpCreatedAt;
    }

    /**
     * @return string|null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @return int|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return string|null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string|null
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @return Email[]
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param $emails
     *
     * @return void
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return Phone[]
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param $phones
     *
     * @return void
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }
}
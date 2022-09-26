<?php

namespace Application\Model\Entity;

use DateTime;
use Laminas\Filter\File\RenameUpload;
use Laminas\Filter\ToInt;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\Between;
use Laminas\Validator\Date;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\IsCountable;
use Laminas\Validator\StringLength;

class Profile implements InputFilterAwareInterface, HydratorAwareInterface
{
    protected ?int $id;
    protected ?string $surname;
    protected ?string $name;
    protected ?string $patronymic;
    protected ?int $gender;
    protected ?string $birthday;
    protected ?string $image;
    protected ?array $imageFile;
    protected ?string $skype;
    /** @var Email[] */
    protected array $emails;
    /** @var Phone[] */
    protected array $phones;
    protected HydratorInterface $hydrator;
    protected InputFilterInterface $inputFilter;

    /**
     * @param Email[]     $emails
     * @param Phone[]     $phones
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
        $emails = [],
        $phones = [],
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
        $this->surname = $surname;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->imageFile = [
            'name'     => '',
            'type'     => '',
            'tmp_name' => '',
            'error'    => 4,
            'size'     => 0,
        ];
        $this->skype = $skype;
        $this->emails = $emails;
        $this->phones = $phones;

        $this->inputFilter = new InputFilter();
        $this->inputFilter->add([
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
        $this->inputFilter->add([
            'name'       => 'surname',
            'required'   => false,
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
        $this->inputFilter->add([
            'name'       => 'name',
            'required'   => false,
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
        $this->inputFilter->add([
            'name'       => 'patronymic',
            'required'   => false,
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
        $this->inputFilter->add([
            'name'       => 'gender',
            'required'   => false,
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
        $this->inputFilter->add([
            'name'       => 'birthday',
            'required'   => false,
            'validators' => [
                [
                    'name'    => Date::class,
                    'options' => [
                        'format' => 'Y-m-d',
                    ],
                ],
            ],
        ]);
        $this->inputFilter->add([
            'name'     => 'imageFile',
            'required' => false,
            'filters'  => [
                [
                    'name'    => RenameUpload::class,
                    'options' => [
                        'target'               => './public/img/',
                        'randomize'            => true,
                        'use_upload_extension' => true,
                    ],
                ],
            ],
        ]);
        $this->inputFilter->add([
            'name'     => 'image',
            'required' => false,
        ]);
        $this->inputFilter->add([
            'name'       => 'skype',
            'required'   => false,
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
        $this->inputFilter->add([
            'name'       => 'emails',
            'required'   => true,
            'validators' => [
                [
                    'name' => IsCountable::class,
                ],
            ],
        ]);
        $this->inputFilter->add([
            'name'       => 'phones',
            'required'   => false,
            'validators' => [
                [
                    'name' => IsCountable::class,
                ],
            ],
        ]);

        $this->hydrator = new ClassMethodsHydrator(false);
        $this->hydrator->addStrategy('id', new NullableStrategy(ScalarTypeStrategy::createToInt(), true));
        $this->hydrator->addStrategy('surname', new NullableStrategy(ScalarTypeStrategy::createToString(), true));
        $this->hydrator->addStrategy('name', new NullableStrategy(ScalarTypeStrategy::createToString(), true));
        $this->hydrator->addStrategy('patronymic', new NullableStrategy(ScalarTypeStrategy::createToString(), true));
        $this->hydrator->addStrategy('gender', new NullableStrategy(ScalarTypeStrategy::createToInt(), true));
        $this->hydrator->addStrategy('birthday', new NullableStrategy(ScalarTypeStrategy::createToString(), true));
        $this->hydrator->addStrategy('image', new NullableStrategy(ScalarTypeStrategy::createToString(), true));
        $this->hydrator->addStrategy('skype', new NullableStrategy(ScalarTypeStrategy::createToString(), true));
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    public function setInputFilter($inputFilter)
    {
        $this->inputFilter = $inputFilter;
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
     * @return string|null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @param string|null $patronymic
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @return int|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int|null $gender
     */
    public function setGender(?int $gender)
    {
        $this->gender = $gender;
    }

    public function getGenderString()
    {
        if ($this->gender == 1) {
            $gender = 'Мужской';
        } elseif ($this->gender == 2) {
            $gender = 'Женский';
        } else {
            $gender = 'Не указан';
        }

        return $gender;
    }

    /**
     * @return string|null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string|null $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getAgeString()
    {
        $age = 'Не указан';

        if ($this->birthday) {
            $age = (new DateTime($this->birthday))->diff(new DateTime())->y;
            $ageLastNumber = $age % 10;
            $old = '';
            $isExclusion = ($age % 100 >= 11) && ($age % 100 <= 14);
            if ($ageLastNumber == 1) {
                $old = "год";
            } elseif ($ageLastNumber == 0 || $ageLastNumber >= 5) {
                $old = "лет";
            } elseif ($ageLastNumber >= 2 && $ageLastNumber <= 4) {
                $old = "года";
            }
            if ($isExclusion) {
                $old = "лет";
            }

            $age .= ' ' . $old;
        }

        return $age;
    }

    /**
     * @return string|null
     */
    public function getImagePath()
    {
        $pos = strpos($this->image, '/img/');
        return file_exists($this->getImage()) ?
            substr($this->image, $pos) :
            '/img/headshot-1024x1024.jpg';
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param string|null $skype
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
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

    /**
     * @return array|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param array|null $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }
}
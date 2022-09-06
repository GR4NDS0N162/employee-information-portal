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
use Laminas\Validator\Between;
use Laminas\Validator\Date;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\IsCountable;
use Laminas\Validator\StringLength;

class Profile implements InputFilterAwareInterface, HydratorAwareInterface
{
    /**
     * @var int|null
     */
    protected $id;
    /**
     * @var string|null
     */
    protected $surname;
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $patronymic;
    /**
     * @var int|null
     */
    protected $gender;
    /**
     * @var string|null
     */
    protected $birthday;
    /**
     * @var string|null
     */
    protected $image;
    /**
     * @var string|null
     */
    protected $skype;
    /**
     * @var Email[]
     */
    protected $emails;
    /**
     * @var Phone[]
     */
    protected $phones;
    /**
     * @var HydratorInterface
     */
    protected $hydrator;
    /**
     * @var InputFilterInterface
     */
    protected $inputFilter;

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
        // TODO: Добавить inputFilter для фото пользователя
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
        $this->hydrator->addStrategy('surname', new NullableStrategy(ScalarTypeStrategy::createToString()));
        $this->hydrator->addStrategy('name', new NullableStrategy(ScalarTypeStrategy::createToString()));
        $this->hydrator->addStrategy('patronymic', new NullableStrategy(ScalarTypeStrategy::createToString()));
        $this->hydrator->addStrategy('gender', new NullableStrategy(ScalarTypeStrategy::createToInt()));
        $this->hydrator->addStrategy('birthday', new NullableStrategy(ScalarTypeStrategy::createToString()));
        // TODO: Добавить подходящую стратегию для фото пользователя
        $this->hydrator->addStrategy('skype', new NullableStrategy(ScalarTypeStrategy::createToString()));
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
}
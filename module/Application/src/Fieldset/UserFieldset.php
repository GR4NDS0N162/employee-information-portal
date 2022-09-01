<?php

namespace Application\Fieldset;

use Application\Model\Entity\User;
use Application\Model\Options\PositionOptions;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;
use Laminas\Hydrator\ClassMethodsHydrator;

class UserFieldset extends ProfileFieldset
{
    /**
     * @var PositionOptions
     */
    private $positionOptions;

    public function __construct(
        PositionOptions $positionOptions,
                        $name = null,
        array           $options = []
    ) {
        parent::__construct($name, $options);

        $this->positionOptions = $positionOptions;
    }

    public function init()
    {
        parent::init();

        $object = new User();
        $this->setObject($object);

        $hydrator = new ClassMethodsHydrator(true, true);
        $this->setHydrator($hydrator);

        $this->setPriority('emails', -100);
        $this->setPriority('phones', -100);

        $this->add([
            'name'       => 'positionId',
            'type'       => Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => $this->positionOptions->getOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'type'       => Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
                'minlength'   => 8,
                'maxlength'   => 32,
                'pattern'     => '^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$',
            ],
            'options'    => [
                'label'            => 'Пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'status',
            'type'       => StatusFieldset::class,
            'attributes' => [
                'class' => 'row gy-1',
            ],
        ]);
    }
}
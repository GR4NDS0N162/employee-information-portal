<?php

namespace Application\Fieldset;

use Application\Model\Entity\User;
use Application\Model\Options\PositionOptions;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;

class UserFieldset extends ProfileFieldset
{
    const DEFAULT_CHECK_LABEL_ATTRIBUTES = [
        'class' => 'form-check-label',
    ];

    private PositionOptions $positionOptions;

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

        $this->setObject(new User());

        $this->setPriority('emails', -100);
        $this->setPriority('phones', -100);

        $this->add([
            'name'       => 'genNewPassword',
            'type'       => Checkbox::class,
            'attributes' => [
                'class' => 'form-check-input',
                'id'    => uniqid('checkbox_', true),
            ],
            'options'    => [
                'label'              => 'Сгенерировать пароль и отправить на почту',
                'label_attributes'   => UserFieldset::DEFAULT_CHECK_LABEL_ATTRIBUTES,
                'use_hidden_element' => false,
            ],
        ], ['priority' => -200]);

        $this->add([
            'name'       => 'positionId',
            'type'       => Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
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
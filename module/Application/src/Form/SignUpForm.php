<?php

namespace Application\Form;

use Application\Form\Options\PositionOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class SignUpForm extends Form
{
    public const DEFAULT_NAME = 'signup-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', '');

        $this->add([
            'name'       => 'email',
            'type'       => Element\Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
            'options'    => [
                'label'            => 'E-mail',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'position',
            'type'       => Element\Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => PositionOptions::getDisabledOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'new-password',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'        => 'form-control',
                'placeholder'  => 'qwerty123',
                'required'     => 'required',
                'autocomplete' => 'new-password',
                'minlength'    => 8,
                'maxlength'    => 32,
                'pattern'      => '^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$',
            ],
            'options'    => [
                'label'            => 'Пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'password-check',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
                'pattern'     => '',
            ],
            'options'    => [
                'label'            => 'Подтверждение пароля',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'submit-button',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-lg btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Зарегистрироваться',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);
    }
}

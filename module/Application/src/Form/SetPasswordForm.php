<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class SetPasswordForm extends Form
{
    public const DEFAULT_NAME = 'set-password-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', '');

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
                'label'            => 'Новый пароль',
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
                'class' => 'btn btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Установить пароль',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);
    }
}

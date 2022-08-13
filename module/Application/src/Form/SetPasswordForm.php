<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class SetPasswordForm extends Form
{
    protected $newPassword = [
        'name' => 'new-password',
        'type' => Element\Password::class,
        'attributes' => [
            'class' => 'form-control',
            'placeholder' => 'qwerty123',
            'required' => 'required',
            'autocomplete' => 'new-password',
            'minlength' => 8,
            'maxlength' => 32,
            'pattern' => '^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$',
        ],
        'options' => [
            'label' => 'Новый пароль',
            'label_attributes' => [
                'class' => 'form-label',
            ],
        ],
    ];

    protected $passwordCheck = [
        'name' => 'password-check',
        'type' => Element\Password::class,
        'attributes' => [
            'class' => 'form-control',
            'placeholder' => 'qwerty123',
            'required' => 'required',
            'pattern' => '',
        ],
        'options' => [
            'label' => 'Подтверждение пароля',
            'label_attributes' => [
                'class' => 'form-label',
            ],
        ],
    ];

    protected $submitButton = [
        'name' => 'submit-button',
        'type' => Element\Button::class,
        'attributes' => [
            'type' => 'submit',
            'class' => 'btn btn-outline-success w-100',
        ],
        'options' => [
            'label' => 'Установить пароль',
        ],
    ];

    public function __construct($name = 'set-password-form')
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', '');

        $this->add($this->newPassword);
        $this->add($this->passwordCheck);
        $this->add($this->submitButton);
    }
}

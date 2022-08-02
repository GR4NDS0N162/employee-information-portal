<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class ChangePasswordForm extends Form
{
    public function __construct()
    {
        parent::__construct('change-password-form');

        $this->setAttribute('class','row gy-3');

        $this->add([
            'name' => 'current-password',
            'type' => Element\Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'qwerty123',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Текущий пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name' => 'new-password',
            'type' => Element\Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'qwerty123',
                'required' => 'required',
                'pattern' => '^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(?=\S+$).{8,32}$',
            ],
            'options' => [
                'label' => 'Новый пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name' => 'password-check',
            'type' => Element\Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'qwerty123',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Подтверждение пароля',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name' => 'submit-button',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options' => [
                'label' => 'Изменить пароль',
            ],
        ]);
    }
}

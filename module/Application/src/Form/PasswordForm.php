<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class PasswordForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
            'class'      => 'row gy-3',
            'method'     => 'post',
            'id'         => 'password-form',
            'novalidate' => 'novalidate',
        ];

        $this->add([
            'name'       => 'password-current',
            'type'       => Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Текущий пароль',
                'id'          => 'password-current-field',
                'required'    => 'required',
            ],
            'options'    => [
                'label' => 'Текущий пароль',
            ],
        ]);
        $this->add([
            'name'       => 'password-new',
            'type'       => Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Новый пароль',
                'id'          => 'password-new-field',
                'required'    => 'required',
                'pattern'     => SignUpForm::passwordPattern,
            ],
            'options'    => [
                'label' => 'Новый пароль',
            ],
        ]);
        $this->add([
            'name'       => 'password-check',
            'type'       => Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Подтверждение пароля',
                'id'          => 'password-check-field',
                'required'    => 'required',
            ],
            'options'    => [
                'label' => 'Подтверждение пароля',
            ],
        ]);
        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [
                'class' => 'btn btn-outline-success w-100',
                'value' => 'Изменить пароль',
            ],
        ]);
    }
}

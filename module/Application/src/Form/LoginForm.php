<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
            'class' => 'row gy-3 mb-3',
            'action' => '//process',
            'method' => 'post',
            'id' => 'login-form',
            'novalidate' => 'novalidate',
        ];

        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'E-mail',
                'id' => 'email-field-login',
                'required' => 'required',
                'pattern' => SignUpForm::emailPattern,
            ],
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Пароль',
                'id' => 'password-field-login',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Пароль',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'class' => 'btn btn-lg btn-outline-primary w-100',
                'value' => 'Войти',
            ],
        ]);
    }
}

<?php

namespace Application\Form\Login;

use Application\Helper\FieldsetMapper;
use Laminas\Form\Element;
use Laminas\Form\Form;

class LoginForm extends Form
{
    public const DEFAULT_NAME = 'login-form';

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
            'name'       => 'current-password',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
            ],
            'options'    => [
                'label'            => 'Пароль',
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
                'class' => 'btn btn-lg btn-outline-primary w-100',
            ],
            'options'    => [
                'label' => 'Войти',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'email'            => 'col-12',
                'current-password' => 'col-12',
                'submit-button'    => 'col-12',
            ],
        ]);
    }
}

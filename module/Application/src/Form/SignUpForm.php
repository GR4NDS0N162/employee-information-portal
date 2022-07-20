<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class SignUpForm extends Form
{
    const emailPattern = '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$';
    const passwordPattern = '^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(?=\S+$).{8,32}$';

    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
            'class'      => 'row gy-3 mb-3',
            'method'     => 'post',
            'id'         => 'signup-form',
            'novalidate' => 'novalidate',
        ];

        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '#',
                'required' => 'required',
                'pattern' => self::emailPattern,
            ],
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'position',
            'type' => Select::class,
            'attributes' => [
                'class' => 'form-select',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Должность',
                'options' => [
                    null => [
                        'label' => 'Не выбрана',
                        'disabled' => 'disabled',
                        'selected' => 'selected',
                    ],
                    '1' => 'Уборщик',
                    '2' => 'Фасовщик',
                    '3' => 'Менеджер',
                    '4' => 'Швейцар',
                    '5' => 'Шеф',
                    '6' => 'Экономист',
                    '7' => 'Электрик',
                    '8' => 'Юрист',
                ],
            ],
        ]);
        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '#',
                'required' => 'required',
                'pattern' => self::passwordPattern,
            ],
            'options' => [
                'label' => 'Пароль',
            ],
        ]);
        $this->add([
            'name' => 'password-check',
            'type' => Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => '#',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Подтверждение пароля',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'class' => 'btn btn-lg btn-outline-success w-100',
                'value' => 'Зарегистрироваться',
            ],
        ]);
    }
}

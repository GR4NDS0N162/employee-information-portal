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
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'position',
            'type' => Select::class,
            'attributes' => [
                'aria-label' => "Должность",
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
            'options' => [
                'label' => 'Пароль',
            ],
        ]);
        $this->add([
            'name' => 'password-check',
            'type' => Password::class,
            'options' => [
                'label' => 'Подтверждение пароля',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Зарегистрироваться',
            ],
        ]);
    }
}

<?php

use Laminas\Form\Element\Password;

return [
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
];

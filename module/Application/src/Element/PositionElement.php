<?php

use Laminas\Form\Element\Select;

return [
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
];

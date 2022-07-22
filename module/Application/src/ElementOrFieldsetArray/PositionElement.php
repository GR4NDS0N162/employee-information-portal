<?php

use Laminas\Form\Element\Text;

return [
    'name' => 'position',
    'type' => Text::class,
    'attributes' => [
        'class' => 'form-control',
        'placeholder' => 'Уборщик',
        'required' => 'required',
    ],
];

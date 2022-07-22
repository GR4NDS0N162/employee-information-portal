<?php

namespace Application\ElementOrFieldsetArray;

use Laminas\Form\Element\Button;

return [
    'name' => 'submit-button',
    'type' => Button::class,
    'attributes' => [
        'type' => 'submit',
        'class' => 'btn w-100',
        'value' => 'Отправить',
    ],
];

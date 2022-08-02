<?php

namespace Application\ElementOrFieldsetArray;

use Laminas\Form\Element\Button;

return [
    'name' => 'add-button',
    'type' => Button::class,
    'attributes' => [
        'class' => 'btn btn-lg btn-outline-primary w-100',
        'onclick' => 'add_item()',
    ],
];

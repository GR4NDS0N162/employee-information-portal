<?php

namespace Application\ElementOrFieldsetArray;

use Application\Fieldset\PositionFieldset;
use Laminas\Form\Element\Collection;

return [
    'name' => 'positions',
    'type' => Collection::class,
    'attributes' => [
        'class' => 'row g-3',
    ],
    'options' => [
        'count' => 4,
        'should_create_template' => true,
        'allow_add' => true,
        'allow_remove' => true,
        'target_element' => [
            'type' => PositionFieldset::class,
        ],
    ],
];

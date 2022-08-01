<?php

namespace Application\ElementOrFieldsetArray;

use Laminas\Form\Element\Button;

return [
    'name' => 'delete-button',
    'type' => Button::class,
    'attributes' => [
        'class' => 'btn btn-outline-danger',
    ],
    'options' => [
        'label' => '<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title></title><g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"></line><line class="cls-1" x1="7" x2="25" y1="25" y2="7"></line></g></svg>',
        'label_options' => [
            'disable_html_escape' => true,
        ],
    ],
];

<?php

namespace Application\ElementOrFieldsetArray;

use Laminas\Form\Element\Submit;

return [
    'name' => 'submit',
    'type' => Submit::class,
    'attributes' => [
        'class' => 'btn w-100',
        'value' => 'Отправить',
    ],
];

<?php

namespace Application\Element;

use Laminas\Form\Element\Email;

return [
    'name' => 'email',
    'type' => Email::class,
    'attributes' => [
        'class' => 'form-control',
        'placeholder' => '#',
        'required' => 'required',
        'pattern' => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
    ],
    'options' => [
        'label' => 'E-mail',
    ],
];

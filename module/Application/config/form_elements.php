<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
    ],
    'factories' => [
        Form\ProfileForm::class => InvokableFactory::class,
    ],
];
<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
        'userFormHelper' => Helper\UserFormHelper::class,
    ],
    'factories' => [
        Helper\UserFormHelper::class => InvokableFactory::class,
    ],
];
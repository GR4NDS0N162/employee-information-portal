<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
        'userFormHelper'       => Helper\UserFormHelper::class,
        'userCollectionHelper' => Helper\UserCollectionHelper::class,
        'userFormRow'          => Helper\UserFormRow::class,
    ],
    'factories' => [
        Helper\UserFormHelper::class       => InvokableFactory::class,
        Helper\UserCollectionHelper::class => InvokableFactory::class,
        Helper\UserFormRow::class          => InvokableFactory::class,
    ],
];
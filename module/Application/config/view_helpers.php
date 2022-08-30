<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
        'userForm'           => Helper\UserForm::class,
        'viewForm'           => Helper\ViewForm::class,
        'userFormCollection' => Helper\UserFormCollection::class,
        'userFormRow'        => Helper\UserFormRow::class,
    ],
    'factories' => [
        Helper\UserForm::class           => InvokableFactory::class,
        Helper\ViewForm::class           => InvokableFactory::class,
        Helper\UserFormCollection::class => InvokableFactory::class,
        Helper\UserFormRow::class        => InvokableFactory::class,
    ],
];
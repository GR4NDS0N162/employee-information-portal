<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
    ],
    'factories' => [
        Form\UserForm::class        => InvokableFactory::class,
        Form\ProfileForm::class     => InvokableFactory::class,
        Form\ViewProfileForm::class => InvokableFactory::class,
        Form\PositionForm::class    => InvokableFactory::class,
    ],
];
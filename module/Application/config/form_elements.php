<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
    ],
    'factories' => [
        Form\ProfileForm::class     => InvokableFactory::class,
        Form\ViewProfileForm::class => InvokableFactory::class,
    ],
];
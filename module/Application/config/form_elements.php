<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
    ],
    'factories' => [
        Form\Admin\UserForm::class       => InvokableFactory::class,
        Form\User\ProfileForm::class     => InvokableFactory::class,
        Form\User\ViewProfileForm::class => InvokableFactory::class,
        Form\Admin\PositionForm::class   => InvokableFactory::class,
    ],
];
<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'aliases'   => [
    ],
    'factories' => [
        Fieldset\UserFieldset::class => Factory\Fieldset\UserFieldsetFactory::class,

        Form\Admin\UserForm::class        => InvokableFactory::class,
        Form\Admin\PositionForm::class    => InvokableFactory::class,
        Form\Admin\AdminFilterForm::class => InvokableFactory::class,

        Form\Login\LoginForm::class   => InvokableFactory::class,
        Form\Login\SignUpForm::class  => Factory\Form\SignUpFormFactory::class,
        Form\Login\RecoverForm::class => InvokableFactory::class,

        Form\Messenger\NewMessageForm::class   => InvokableFactory::class,
        Form\Messenger\DialogFilterForm::class => InvokableFactory::class,

        Form\User\ProfileForm::class        => InvokableFactory::class,
        Form\User\ChangePasswordForm::class => InvokableFactory::class,
        Form\User\ViewProfileForm::class    => InvokableFactory::class,
        Form\User\UserFilterForm::class     => InvokableFactory::class,
    ],
];
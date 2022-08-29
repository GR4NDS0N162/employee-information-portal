<?php

namespace Application;

return [
    'aliases'   => [
    ],
    'factories' => [
        Fieldset\UserFieldset::class => Factory\Fieldset\UserFieldsetFactory::class,

        Form\Login\SignUpForm::class    => Factory\Form\SignUpFormFactory::class,
        Form\User\UserFilterForm::class => Factory\Form\UserFilterFormFactory::class,
    ],
];
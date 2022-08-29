<?php

namespace Application;

return [
    'aliases'   => [
    ],
    'factories' => [
        Fieldset\UserFieldset::class => Factory\Fieldset\UserFieldsetFactory::class,

        Form\Login\SignUpForm::class           => Factory\Form\SignUpFormFactory::class,
        Form\User\UserFilterForm::class        => Factory\Form\UserFilterFormFactory::class,
        Form\Admin\AdminFilterForm::class      => Factory\Form\AdminFilterFormFactory::class,
        Form\Messenger\DialogFilterForm::class => Factory\Form\DialogFilterFormFactory::class,
    ],
];
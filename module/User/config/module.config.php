<?php

namespace User;

use Laminas\Router\Http\Literal;

return [
    'form_elements'   => [
        'factories' => [
        ],
    ],
    'service_manager' => [
        'aliases'   => [
        ],
        'factories' => [
        ],
    ],
    'controllers'     => [
        'factories' => [
            Controller\ProfileController::class => Factory\ProfileControllerFactory::class,
        ],
    ],
    'router'          => [
        'routes' => [
            'profile' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/profile',
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager'    => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

<?php

namespace Home;

use Laminas\Router\Http\Literal;

return [
    'service_manager' => [
        'aliases'   => [
            Model\PositionRepositoryInterface::class => Model\PositionRepository::class,
            Model\UserRepositoryInterface::class     => Model\UserRepository::class,
        ],
        'factories' => [
            Model\PositionRepository::class => Factory\PositionRepositoryFactory::class,
            Model\UserRepository::class     => Factory\UserRepositoryFactory::class,
        ],
    ],
    'controllers'     => [
        'factories' => [
            Controller\HomeController::class => Factory\HomeControllerFactory::class,
        ],
    ],
    'router'          => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\HomeController::class,
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

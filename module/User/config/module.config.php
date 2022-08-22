<?php

namespace User;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases'   => [
            Model\ProfileRepositoryInterface::class => Model\ProfileRepository::class,
            Model\ListRepositoryInterface::class    => Model\ListRepository::class,
        ],
        'factories' => [
            Model\ProfileRepository::class => Factory\ProfileRepositoryFactory::class,
            Model\ListRepository::class    => Factory\ListRepositoryFactory::class,
        ],
    ],
    'controllers'     => [
        'factories' => [
            Controller\ProfileController::class => Factory\ProfileControllerFactory::class,
        ],
    ],
    'router'          => [
        'routes' => [
            'userview' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/userview',
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

<?php

namespace User;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases'   => [
            Model\ProfileRepositoryInterface::class => Model\ProfileRepository::class,
        ],
        'factories' => [
            Model\ProfileRepository::class => Factory\ProfileRepositoryFactory::class,
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

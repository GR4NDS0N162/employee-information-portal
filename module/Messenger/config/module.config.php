<?php

namespace Messenger;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases'   => [
            Model\DialogRepositoryInterface::class => Model\DialogRepository::class,
        ],
        'factories' => [
            Model\DialogRepository::class => Factory\DialogRepositoryFactory::class,
        ],
    ],
    'controllers'     => [
        'factories' => [
            Controller\DialogListController::class => Factory\DialogListControllerFactory::class,
        ],
    ],
    'router'          => [
        'routes' => [
            'messenger' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/im',
                    'defaults' => [
                        'controller' => Controller\DialogListController::class,
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

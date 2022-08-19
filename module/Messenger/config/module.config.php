<?php
declare(strict_types=1);

namespace Messenger;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers'  => [
        'factories' => [
            Controller\DialogListController::class => InvokableFactory::class,
        ],
    ],
    'router'       => [
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
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

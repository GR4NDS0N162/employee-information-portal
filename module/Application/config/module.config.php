<?php

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'profile' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/profile',
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action'     => 'view',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'view' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route' => '/view',
                        ],
                    ],
                    'edit' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/edit',
                            'defaults' => [
                                'action' => 'edit',
                            ],
                        ],
                    ],
                ],
            ],
            'user' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/list',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'list',
                    ],
                ],
            ],
            'admin' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'list',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'list' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route' => '/list',
                        ],
                    ],
                    'edit' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/edit',
                            'defaults' => [
                                'action' => 'edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => InvokableFactory::class,
            Controller\ProfileController::class => InvokableFactory::class,
            Controller\UserController::class => InvokableFactory::class,
            Controller\AdminController::class => InvokableFactory::class,
            Controller\PositionController::class => InvokableFactory::class,
            Controller\MessengerController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

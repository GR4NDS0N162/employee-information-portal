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
                        'action'     => 'login',
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
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'action' => 'edit',
                            ],
                            'constraints' => [
                                'id' => '\d+',
                            ],
                        ],
                    ],
                ],
            ],
            'position' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/position',
                    'defaults' => [
                        'controller' => Controller\PositionController::class,
                        'action'     => 'edit',
                    ],
                ],
            ],
            'messenger' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/messenger',
                    'defaults' => [
                        'controller' => Controller\MessengerController::class,
                        'action'     => 'dialogs',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'dialogs' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route' => '/dialogs',
                        ],
                    ],
                    'messages' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/messages/:id',
                            'defaults' => [
                                'action' => 'messages',
                            ],
                            'constraints' => [
                                'id' => '\d+',
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
    'navigation' => [
        'default' => [
            [
                'label' => 'Профиль',
                'route' => 'profile',
                'pages' => [
                    [
                        'label'  => 'Просмотр',
                        'route'  => 'profile/view',
                    ],
                    [
                        'label'  => 'Редактирование',
                        'route'  => 'profile/edit',
                    ],
                ],
            ],
            [
                'label' => 'Пользователи',
                'route' => 'user',
            ],
            [
                'label' => 'Мессенджер',
                'route' => 'messenger',
            ],
        ],
        'admin' => [
            [
                'label' => 'Профиль',
                'route' => 'profile',
                'pages' => [
                    [
                        'label'  => 'Просмотр',
                        'route'  => 'profile/view',
                    ],
                    [
                        'label'  => 'Редактирование',
                        'route'  => 'profile/edit',
                    ],
                ],
            ],
            [
                'label' => 'Пользователи',
                'route' => 'user',
            ],
            [
                'label' => 'Мессенджер',
                'route' => 'messenger',
            ],
            [
                'label' => 'Администраторам',
                'route' => 'admin',
                'pages' => [
                    [
                        'label'  => 'Пользователи',
                        'route'  => 'admin/list',
                    ],
                    [
                        'label'  => 'Должности',
                        'route'  => 'position',
                    ],
                ],
            ],
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
            'layout/login'            => __DIR__ . '/../view/layout/login.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'positionFieldsetHelper'       => 'Application\Helper\PositionFieldsetHelper',
            'positionElementHelper'        => 'Application\Helper\PositionElementHelper',
            'positionButtonFieldsetHelper' => 'Application\Helper\PositionButtonFieldsetHelper',
            'positionButtonHelper'         => 'Application\Helper\PositionButtonHelper',
        ],
    ],
];

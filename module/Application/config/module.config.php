<?php

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'login',
                    ],
                ],
            ],
            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                    ],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'view-profile' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/view',
                            'defaults' => [
                                'action' => 'view-profile',
                            ],
                        ],
                    ],
                    'edit-profile' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/edit',
                            'defaults' => [
                                'action' => 'edit-profile',
                            ],
                        ],
                    ],
                    'view-user-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'action' => 'view-user-list',
                            ],
                        ],
                    ],
                    'view-dialog-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/im',
                            'defaults' => [
                                'action' => 'view-dialog-list',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'view-messages' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/:id',
                                    'defaults' => [
                                        'action' => 'view-messages',
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
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                    ],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'view-user-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'action' => 'view-user-list',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'edit-user' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/:id',
                                    'defaults' => [
                                        'action' => 'edit-user',
                                    ],
                                    'constraints' => [
                                        'id' => '\d+',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'edit-position' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/positions',
                            'defaults' => [
                                'action' => 'edit-positions',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Профиль',
                'route' => 'user/view-profile',
                'pages' => [
                    [
                        'label' => 'Просмотр',
                        'route' => 'user/view-profile',
                    ],
                    [
                        'label' => 'Редактирование',
                        'route' => 'user/edit-profile',
                    ],
                ],
            ],
            [
                'label' => 'Пользователи',
                'route' => 'user/view-user-list',
            ],
            [
                'label' => 'Диалоги',
                'route' => 'user/view-dialog-list',
            ],
        ],
        'admin' => [
            [
                'label' => 'Профиль',
                'route' => 'user/view-profile',
                'pages' => [
                    [
                        'label' => 'Просмотр',
                        'route' => 'user/view-profile',
                    ],
                    [
                        'label' => 'Редактирование',
                        'route' => 'user/edit-profile',
                    ],
                ],
            ],
            [
                'label' => 'Пользователи',
                'route' => 'user/view-user-list',
            ],
            [
                'label' => 'Диалоги',
                'route' => 'user/view-dialog-list',
            ],
            [
                'label' => 'Администраторам',
                'route' => 'admin/view-user-list',
                'pages' => [
                    [
                        'label' => 'Пользователи',
                        'route' => 'admin/view-user-list',
                    ],
                    [
                        'label' => 'Должности',
                        'route' => 'admin/edit-position',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\LoginController::class => InvokableFactory::class,
            Controller\UserController::class => InvokableFactory::class,
            Controller\AdminController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/login/login' => __DIR__ . '/../view/application/login/login.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

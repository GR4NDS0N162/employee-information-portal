<?php

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'routes' => [
        'home'  => [
            'type'          => Literal::class,
            'options'       => [
                'route'    => '/',
                'defaults' => [
                    'controller' => Controller\LoginController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'login'   => [
                    'type'    => Literal::class,
                    'options' => [
                        'route'    => 'login',
                        'defaults' => [
                            'action' => 'login',
                        ],
                    ],
                ],
                'signup'  => [
                    'type'    => Literal::class,
                    'options' => [
                        'route'    => 'signup',
                        'defaults' => [
                            'action' => 'signup',
                        ],
                    ],
                ],
                'recover' => [
                    'type'    => Literal::class,
                    'options' => [
                        'route'    => 'recover',
                        'defaults' => [
                            'action' => 'recover',
                        ],
                    ],
                ],
            ],
        ],
        'user'  => [
            'type'          => Literal::class,
            'options'       => [
                'route'    => '/user',
                'defaults' => [
                    'controller' => Controller\UserController::class,
                ],
            ],
            'may_terminate' => false,
            'child_routes'  => [
                'view-profile'     => [
                    'type'    => Literal::class,
                    'options' => [
                        'route'    => '/view',
                        'defaults' => [
                            'action' => 'view-profile',
                        ],
                    ],
                ],
                'edit-profile'     => [
                    'type'          => Literal::class,
                    'options'       => [
                        'route'    => '/edit',
                        'defaults' => [
                            'action' => 'edit-profile',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes'  => [
                        'profile-form'         => [
                            'type'    => Literal::class,
                            'options' => [
                                'route'    => '/profile-form',
                                'defaults' => [
                                    'action' => 'profile-form',
                                ],
                            ],
                        ],
                        'change-password-form' => [
                            'type'    => Literal::class,
                            'options' => [
                                'route'    => '/change-password-form',
                                'defaults' => [
                                    'action' => 'change-password-form',
                                ],
                            ],
                        ],
                    ],
                ],
                'view-user-list'   => [
                    'type'    => Literal::class,
                    'options' => [
                        'route'    => '/list',
                        'defaults' => [
                            'action' => 'view-user-list',
                        ],
                    ],
                ],
                'view-dialog-list' => [
                    'type'          => Literal::class,
                    'options'       => [
                        'route'    => '/im',
                        'defaults' => [
                            'controller' => Controller\MessengerController::class,
                            'action'     => 'view-dialog-list',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes'  => [
                        'view-messages' => [
                            'type'    => Segment::class,
                            'options' => [
                                'route'       => '/[:id]',
                                'defaults'    => [
                                    'action' => 'view-messages',
                                ],
                                'constraints' => [
                                    'id' => '[1-9]\d*',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin' => [
            'type'          => Literal::class,
            'options'       => [
                'route'    => '/admin',
                'defaults' => [
                    'controller' => Controller\AdminController::class,
                ],
            ],
            'may_terminate' => false,
            'child_routes'  => [
                'view-user-list' => [
                    'type'          => Literal::class,
                    'options'       => [
                        'route'    => '/list',
                        'defaults' => [
                            'action' => 'view-user-list',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes'  => [
                        'get-users' => [
                            'type'    => Literal::class,
                            'options' => [
                                'route'    => '/get',
                                'defaults' => [
                                    'action' => 'get-users',
                                ],
                            ],
                        ],
                        'edit-user' => [
                            'type'    => Segment::class,
                            'options' => [
                                'route'       => '/[:id]',
                                'defaults'    => [
                                    'action' => 'edit-user',
                                ],
                                'constraints' => [
                                    'id' => '[1-9]\d*',
                                ],
                            ],
                        ],
                    ],
                ],
                'edit-position'  => [
                    'type'    => Literal::class,
                    'options' => [
                        'route'    => '/positions',
                        'defaults' => [
                            'action' => 'edit-positions',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
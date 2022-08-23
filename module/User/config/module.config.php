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
            Model\PhoneRepositoryInterface::class   => Model\PhoneRepository::class,
            Model\EmailRepositoryInterface::class   => Model\EmailRepository::class,
            Model\ProfileRepositoryInterface::class => Model\ProfileRepository::class,
            Model\ProfileCommandInterface::class    => Model\ProfileCommand::class,
        ],
        'factories' => [
            Model\PhoneRepository::class   => Factory\PhoneRepositoryFactory::class,
            Model\EmailRepository::class   => Factory\EmailRepositoryFactory::class,
            Model\ProfileRepository::class => Factory\ProfileRepositoryFactory::class,
            Model\ProfileCommand::class    => Factory\ProfileCommandFactory::class,
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
                'type'          => Literal::class,
                'options'       => [
                    'route'    => '/profile',
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
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
    'view_manager'    => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

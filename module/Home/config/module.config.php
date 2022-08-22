<?php

namespace Home;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'form_elements'   => [
        'factories' => [
            Form\SignUpForm::class => Factory\SignUpFormFactory::class,
        ],
    ],
    'service_manager' => [
        'aliases'   => [
            Model\PositionRepositoryInterface::class => Model\PositionRepository::class,
            Model\UserRepositoryInterface::class     => Model\UserRepository::class,
            Model\EmailRepositoryInterface::class    => Model\EmailRepository::class,
            Model\UserCommandInterface::class        => Model\UserCommand::class,
        ],
        'factories' => [
            Model\PositionRepository::class => Factory\PositionRepositoryFactory::class,
            Model\UserRepository::class     => Factory\UserRepositoryFactory::class,
            Model\EmailRepository::class    => Factory\EmailRepositoryFactory::class,
            Model\UserCommand::class        => InvokableFactory::class,
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

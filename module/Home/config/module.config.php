<?php

namespace Home;

return [
    'service_manager' => [
        'aliases'   => [
        ],
        'factories' => [
        ],
    ],
    'controllers'     => [
        'factories' => [
            Controller\HomeController::class => Factory\HomeControllerFactory::class,
        ],
    ],
    'router'          => [
        'routes' => [
        ],
    ],
    'view_manager'    => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

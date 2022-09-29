<?php

namespace Application;

use Application\Controller\ConsoleController;

return [
    'router' => [
        'routes' => [
            'send-emails' => [
                'type'    => 'simple',
                'options' => [
                    'route'    => 'send-emails',
                    'defaults' => [
                        'controller' => ConsoleController::class,
                        'action'     => 'send-emails',
                    ],
                ],
            ],
        ],
    ],
];
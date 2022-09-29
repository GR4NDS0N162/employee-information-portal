<?php

namespace Application;

use Application\Controller\ConsoleController;

return [
    'router' => [
        'routes' => [
            'send-emails' => [
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
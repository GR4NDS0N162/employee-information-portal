<?php

namespace Application;

use Application\Controller\MessengerController;

return [
    'router' => [
        'routes' => [
            'send-emails' => [
                'options' => [
                    'route'    => 'send-emails',
                    'defaults' => [
                        'controller' => MessengerController::class,
                        'action'     => 'send-emails',
                    ],
                ],
            ],
        ],
    ],
];
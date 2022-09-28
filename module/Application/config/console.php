<?php

namespace Application;

use Application\Controller\MessengerController;

return [
    'console' => [
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
    ],
];
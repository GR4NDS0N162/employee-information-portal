<?php
declare(strict_types=1);

namespace Messenger;

use Laminas\Router\Http\Literal;

return [
    'router' => [
        'routes' => [
            'messenger' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/im',
                    'defaults' => [
                        'controller' => Controller\DialogListController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
];

<?php

namespace Application;

use Application\Factory\Controller as Factory;

return [
    'factories' => [
        Controller\LoginController::class     => Factory\LoginControllerFactory::class,
        Controller\UserController::class      => Factory\UserControllerFactory::class,
        Controller\AdminController::class     => Factory\AdminControllerFactory::class,
        Controller\MessengerController::class => Factory\MessengerControllerFactory::class,
    ],
];
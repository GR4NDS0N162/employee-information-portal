<?php

namespace Application;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'factories' => [
        Controller\LoginController::class     => InvokableFactory::class,
        Controller\UserController::class      => Factory\UserControllerFactory::class,
        Controller\AdminController::class     => InvokableFactory::class,
        Controller\MessengerController::class => InvokableFactory::class,
    ],
];
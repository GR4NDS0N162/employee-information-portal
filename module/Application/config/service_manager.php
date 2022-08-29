<?php

namespace Application;

use Application\Factory\Repository as FactoryRepository;

return [
    'aliases'   => [
        Model\EmailRepositoryInterface::class    => Model\Repository\EmailRepository::class,
        Model\PositionRepositoryInterface::class => Model\Repository\PositionRepository::class,
        Model\UserRepositoryInterface::class     => Model\Repository\UserRepository::class,
    ],
    'factories' => [
        Model\Repository\EmailRepository::class    => FactoryRepository\EmailRepositoryFactory::class,
        Model\Repository\PositionRepository::class => FactoryRepository\PositionRepositoryFactory::class,
        Model\Repository\UserRepository::class     => FactoryRepository\UserRepositoryFactory::class,
    ],
];
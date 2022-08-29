<?php

namespace Application;

use Application\Factory\Repository as FactoryRepository;

return [
    'aliases'   => [
    ],
    'factories' => [
        Model\Repository\EmailRepository::class    => FactoryRepository\EmailRepositoryFactory::class,
        Model\Repository\PositionRepository::class => FactoryRepository\PositionRepositoryFactory::class,
        Model\Repository\UserRepository::class     => FactoryRepository\UserRepositoryFactory::class,
    ],
];
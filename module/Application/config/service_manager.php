<?php

namespace Application;

use Application\Factory\Command as CommandFactory;
use Application\Factory\Options as OptionsFactory;
use Application\Factory\Repository as RepositoryFactory;

return [
    'aliases'   => [
        Model\EmailRepositoryInterface::class    => Model\Repository\EmailRepository::class,
        Model\PhoneRepositoryInterface::class    => Model\Repository\PhoneRepository::class,
        Model\PositionRepositoryInterface::class => Model\Repository\PositionRepository::class,
        Model\UserRepositoryInterface::class     => Model\Repository\UserRepository::class,
        Model\UserCommandInterface::class        => Model\Command\UserCommand::class,
    ],
    'factories' => [
        Model\Command\UserCommand::class => CommandFactory\UserCommandFactory::class,

        Model\Options\PositionOptions::class => OptionsFactory\PositionOptionsFactory::class,

        Model\Repository\EmailRepository::class    => RepositoryFactory\EmailRepositoryFactory::class,
        Model\Repository\PhoneRepository::class    => RepositoryFactory\PhoneRepositoryFactory::class,
        Model\Repository\PositionRepository::class => RepositoryFactory\PositionRepositoryFactory::class,
        Model\Repository\UserRepository::class     => RepositoryFactory\UserRepositoryFactory::class,
    ],
];
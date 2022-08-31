<?php

namespace Application;

use Application\Factory\Command as CommandFactory;
use Application\Factory\Options as OptionsFactory;
use Application\Factory\Repository as RepositoryFactory;

return [
    'aliases'   => [
        Model\Repository\EmailRepositoryInterface::class      => Model\Repository\EmailRepository::class,
        Model\Repository\PhoneRepositoryInterface::class      => Model\Repository\PhoneRepository::class,
        Model\Repository\PositionRepositoryInterface::class   => Model\Repository\PositionRepository::class,
        Model\Repository\StatusRepositoryInterface::class     => Model\Repository\StatusRepository::class,
        Model\Repository\UserRepositoryInterface::class       => Model\Repository\UserRepository::class,
        Model\Repository\UserStatusRepositoryInterface::class => Model\Repository\UserStatusRepository::class,
        Model\Command\UserCommandInterface::class             => Model\Command\UserCommand::class,
    ],
    'factories' => [
        Model\Command\UserCommand::class => CommandFactory\UserCommandFactory::class,

        Model\Options\PositionOptions::class => OptionsFactory\PositionOptionsFactory::class,

        Model\Repository\EmailRepository::class      => RepositoryFactory\EmailRepositoryFactory::class,
        Model\Repository\PhoneRepository::class      => RepositoryFactory\PhoneRepositoryFactory::class,
        Model\Repository\PositionRepository::class   => RepositoryFactory\PositionRepositoryFactory::class,
        Model\Repository\StatusRepository::class     => RepositoryFactory\StatusRepositoryFactory::class,
        Model\Repository\UserRepository::class       => RepositoryFactory\UserRepositoryFactory::class,
        Model\Repository\UserStatusRepository::class => RepositoryFactory\UserStatusRepositoryFactory::class,
    ],
];
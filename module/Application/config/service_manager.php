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
        Model\Repository\UserInfoRepositoryInterface::class   => Model\Repository\UserInfoRepository::class,
        Model\Repository\DialogRepositoryInterface::class     => Model\Repository\DialogRepository::class,
        Model\Repository\MessageRepositoryInterface::class    => Model\Repository\MessageRepository::class,
        Model\Command\UserCommandInterface::class             => Model\Command\UserCommand::class,
        Model\Command\PositionCommandInterface::class         => Model\Command\PositionCommand::class,
        Model\Command\EmailCommandInterface::class            => Model\Command\EmailCommand::class,
        Model\Command\PhoneCommandInterface::class            => Model\Command\PhoneCommand::class,
    ],
    'factories' => [
        Model\Command\UserCommand::class     => CommandFactory\UserCommandFactory::class,
        Model\Command\PositionCommand::class => CommandFactory\PositionCommandFactory::class,
        Model\Command\EmailCommand::class    => CommandFactory\EmailCommandFactory::class,
        Model\Command\PhoneCommand::class    => CommandFactory\PhoneCommandFactory::class,

        Model\Options\PositionOptions::class => OptionsFactory\PositionOptionsFactory::class,

        Model\Repository\EmailRepository::class      => RepositoryFactory\EmailRepositoryFactory::class,
        Model\Repository\PhoneRepository::class      => RepositoryFactory\PhoneRepositoryFactory::class,
        Model\Repository\PositionRepository::class   => RepositoryFactory\PositionRepositoryFactory::class,
        Model\Repository\StatusRepository::class     => RepositoryFactory\StatusRepositoryFactory::class,
        Model\Repository\UserRepository::class       => RepositoryFactory\UserRepositoryFactory::class,
        Model\Repository\UserStatusRepository::class => RepositoryFactory\UserStatusRepositoryFactory::class,
        Model\Repository\UserInfoRepository::class   => RepositoryFactory\UserInfoRepositoryFactory::class,
        Model\Repository\DialogRepository::class     => RepositoryFactory\DialogRepositoryFactory::class,
        Model\Repository\MessageRepository::class    => RepositoryFactory\MessageRepositoryFactory::class,
    ],
];
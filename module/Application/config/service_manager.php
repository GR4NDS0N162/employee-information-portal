<?php

namespace Application;

use Application\Factory\Command as CommandFactory;
use Application\Factory\Options as OptionsFactory;
use Application\Factory\Repository as RepositoryFactory;
use Application\Model\Command as Command;
use Application\Model\Options as Options;
use Application\Model\Repository as Repository;

return [
    'aliases'   => [
        Repository\EmailRepositoryInterface::class      => Repository\EmailRepository::class,
        Repository\PhoneRepositoryInterface::class      => Repository\PhoneRepository::class,
        Repository\PositionRepositoryInterface::class   => Repository\PositionRepository::class,
        Repository\StatusRepositoryInterface::class     => Repository\StatusRepository::class,
        Repository\UserRepositoryInterface::class       => Repository\UserRepository::class,
        Repository\UserStatusRepositoryInterface::class => Repository\UserStatusRepository::class,
        Repository\UserInfoRepositoryInterface::class   => Repository\UserInfoRepository::class,
        Repository\DialogRepositoryInterface::class     => Repository\DialogRepository::class,
        Repository\MessageRepositoryInterface::class    => Repository\MessageRepository::class,

        Command\UserCommandInterface::class     => Command\UserCommand::class,
        Command\PositionCommandInterface::class => Command\PositionCommand::class,
        Command\EmailCommandInterface::class    => Command\EmailCommand::class,
        Command\PhoneCommandInterface::class    => Command\PhoneCommand::class,
    ],
    'factories' => [
        Command\UserCommand::class     => CommandFactory\UserCommandFactory::class,
        Command\PositionCommand::class => CommandFactory\PositionCommandFactory::class,
        Command\EmailCommand::class    => CommandFactory\EmailCommandFactory::class,
        Command\PhoneCommand::class    => CommandFactory\PhoneCommandFactory::class,

        Options\PositionOptions::class => OptionsFactory\PositionOptionsFactory::class,

        Repository\EmailRepository::class      => RepositoryFactory\EmailRepositoryFactory::class,
        Repository\PhoneRepository::class      => RepositoryFactory\PhoneRepositoryFactory::class,
        Repository\PositionRepository::class   => RepositoryFactory\PositionRepositoryFactory::class,
        Repository\StatusRepository::class     => RepositoryFactory\StatusRepositoryFactory::class,
        Repository\UserRepository::class       => RepositoryFactory\UserRepositoryFactory::class,
        Repository\UserStatusRepository::class => RepositoryFactory\UserStatusRepositoryFactory::class,
        Repository\UserInfoRepository::class   => RepositoryFactory\UserInfoRepositoryFactory::class,
        Repository\DialogRepository::class     => RepositoryFactory\DialogRepositoryFactory::class,
        Repository\MessageRepository::class    => RepositoryFactory\MessageRepositoryFactory::class,
    ],
];
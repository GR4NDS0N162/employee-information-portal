<?php

namespace Application\Command;

use Application\Model\Command\NotifierInterface;
use Application\Model\Repository\MessageRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class NotifyUsersCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new NotifyUsersCommand(
            $container->get(AdapterInterface::class),
            $container->get(MessageRepositoryInterface::class),
            $container->get(NotifierInterface::class),
        );
    }
}
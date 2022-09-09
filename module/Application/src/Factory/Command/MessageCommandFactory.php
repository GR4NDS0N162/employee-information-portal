<?php

namespace Application\Factory\Command;

use Application\Model\Command\MessageCommand;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MessageCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new MessageCommand(
            $container->get(AdapterInterface::class),
        );
    }
}
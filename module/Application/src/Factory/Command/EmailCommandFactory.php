<?php

namespace Application\Factory\Command;

use Application\Model\Command\EmailCommand;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class EmailCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new EmailCommand(
            $container->get(AdapterInterface::class),
        );
    }
}
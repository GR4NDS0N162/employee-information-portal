<?php

namespace Application\Command;

use Application\Model\Repository\MessageRepositoryInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MyCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new MyCommand(
            $container->get(MessageRepositoryInterface::class),
        );
    }
}
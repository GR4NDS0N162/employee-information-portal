<?php

namespace Application\Factory\Command;

use Application\Model\Command\PositionCommand;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class PositionCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new PositionCommand();
    }
}
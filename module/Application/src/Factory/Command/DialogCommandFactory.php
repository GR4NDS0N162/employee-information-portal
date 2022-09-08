<?php

namespace Application\Factory\Command;

use Application\Model\Command\DialogCommand;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class DialogCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new DialogCommand();
    }
}
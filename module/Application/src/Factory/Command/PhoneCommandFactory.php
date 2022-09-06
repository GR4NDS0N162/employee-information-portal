<?php

namespace Application\Factory\Command;

use Application\Model\Command\PhoneCommand;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class PhoneCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new PhoneCommand();
    }
}
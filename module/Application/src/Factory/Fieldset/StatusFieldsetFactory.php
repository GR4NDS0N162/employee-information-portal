<?php

namespace Application\Factory\Fieldset;

use Application\Fieldset\StatusFieldset;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class StatusFieldsetFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new StatusFieldset();
    }
}
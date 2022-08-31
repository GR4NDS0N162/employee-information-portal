<?php

namespace Application\Factory\Options;

use Application\Model\Options\PositionOptions;
use Application\Model\Repository\PositionRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PositionOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new PositionOptions(
            $container->get(PositionRepositoryInterface::class),
        );
    }
}
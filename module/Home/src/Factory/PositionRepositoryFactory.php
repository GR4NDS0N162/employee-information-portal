<?php

namespace Home\Factory;

use Home\Model\Position;
use Home\Model\PositionRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PositionRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new PositionRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new Position(''),
        );
    }
}

<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Model\ListItem;
use User\Model\ListRepository;

class ListRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new ListRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new ListItem('')
        );
    }
}

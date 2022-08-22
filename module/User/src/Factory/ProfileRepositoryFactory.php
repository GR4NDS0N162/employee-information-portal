<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Model\Profile;
use User\Model\ProfileRepository;

class ProfileRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new ProfileRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new Profile('','','','','', '', '', '')
        );
    }
}
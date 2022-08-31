<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\UserStatus;
use Application\Model\Repository\UserStatusRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserStatusRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new UserStatusRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new UserStatus(),
        );
    }
}
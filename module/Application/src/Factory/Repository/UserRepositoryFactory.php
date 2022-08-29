<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\User;
use Application\Model\Repository\UserRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new UserRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new User(),
        );
    }
}
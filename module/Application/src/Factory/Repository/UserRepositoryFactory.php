<?php

namespace Application\Factory\Repository;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\User;
use Application\Model\PhoneRepositoryInterface;
use Application\Model\Repository\UserRepository;
use Application\Model\StatusRepositoryInterface;
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
            $container->get(EmailRepositoryInterface::class),
            $container->get(PhoneRepositoryInterface::class),
            $container->get(StatusRepositoryInterface::class),
        );
    }
}
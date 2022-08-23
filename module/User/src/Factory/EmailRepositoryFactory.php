<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Model\Email;
use User\Model\EmailRepository;

class EmailRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new EmailRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new Email(''),
        );
    }
}

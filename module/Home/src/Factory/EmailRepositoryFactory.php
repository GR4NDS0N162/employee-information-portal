<?php

namespace Home\Factory;

use Home\Model\Email;
use Home\Model\EmailRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

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

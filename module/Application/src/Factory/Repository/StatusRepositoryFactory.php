<?php

namespace Application\Factory\Repository;

use Application\Model\Repository\StatusRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class StatusRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new StatusRepository(
            $container->get(AdapterInterface::class),
        );
    }
}
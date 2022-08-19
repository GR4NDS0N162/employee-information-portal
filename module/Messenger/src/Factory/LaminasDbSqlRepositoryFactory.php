<?php

namespace Messenger\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Messenger\Model\LaminasDbSqlRepository;

class LaminasDbSqlRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new LaminasDbSqlRepository($container->get(AdapterInterface::class));
    }
}

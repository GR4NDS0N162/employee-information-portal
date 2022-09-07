<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\Dialog;
use Application\Model\Repository\DialogRepository;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class DialogRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new DialogRepository(
            $container->get(AdapterInterface::class),
            new Dialog(),
        );
    }
}
<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\Status;
use Application\Model\Repository\StatusRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class StatusRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $prototype = new Status();

        return new StatusRepository(
            $container->get(AdapterInterface::class),
            $prototype->getHydrator(),
            $prototype,
        );
    }
}
<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\Phone;
use Application\Model\Repository\PhoneRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PhoneRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $prototype = new Phone();

        return new PhoneRepository(
            $container->get(AdapterInterface::class),
            $prototype->getHydrator(),
            $prototype,
        );
    }
}
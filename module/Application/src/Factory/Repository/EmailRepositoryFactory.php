<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\Email;
use Application\Model\Repository\EmailRepository;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class EmailRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $prototype = new Email();

        return new EmailRepository(
            $container->get(AdapterInterface::class),
            $prototype->getHydrator(),
            $prototype,
        );
    }
}
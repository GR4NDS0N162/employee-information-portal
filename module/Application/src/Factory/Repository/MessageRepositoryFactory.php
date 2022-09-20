<?php

namespace Application\Factory\Repository;

use Application\Model\Repository\MessageRepository;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class MessageRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new MessageRepository(
            $container->get(AdapterInterface::class),
        );
    }
}
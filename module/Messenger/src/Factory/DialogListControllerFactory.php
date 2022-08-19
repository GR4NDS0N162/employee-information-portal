<?php

namespace Messenger\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Messenger\Controller\DialogListController;
use Messenger\Model\DialogRepositoryInterface;

class DialogListControllerFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param string $requestedName
     * @param null|array<mixed> $options
     * @return object
     * @throws ServiceNotFoundException If unable to resolve the service.
     * @throws ServiceNotCreatedException If an exception is raised when creating a service.
     * @throws ContainerException If any other error occurs.
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new DialogListController($container->get(DialogRepositoryInterface::class));
    }
}

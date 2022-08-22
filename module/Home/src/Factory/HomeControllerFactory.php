<?php

namespace Home\Factory;

use Home\Controller\HomeController;
use Home\Model\EmailRepositoryInterface;
use Home\Model\PositionRepositoryInterface;
use Home\Model\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class HomeControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new HomeController(
            $container->get(PositionRepositoryInterface::class),
            $container->get(UserRepositoryInterface::class),
            $container->get(EmailRepositoryInterface::class),
        );
    }
}

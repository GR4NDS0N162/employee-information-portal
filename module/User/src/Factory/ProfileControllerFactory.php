<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\ProfileController;
use User\Model\EmailRepositoryInterface;
use User\Model\PhoneRepositoryInterface;

class ProfileControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new ProfileController(
            $container->get(PhoneRepositoryInterface::class),
            $container->get(EmailRepositoryInterface::class),
        );
    }
}

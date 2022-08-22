<?php

namespace Home\Factory;

use Home\Form\SignUpForm;
use Home\Model\PositionRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SignUpFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new SignUpForm(
            $container->get(PositionRepositoryInterface::class),
        );
    }
}

<?php

namespace Application\Factory\Fieldset;

use Application\Fieldset\UserFieldset;
use Application\Model\Options\PositionOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserFieldsetFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new UserFieldset(
            $container->get(PositionOptions::class),
        );
    }
}
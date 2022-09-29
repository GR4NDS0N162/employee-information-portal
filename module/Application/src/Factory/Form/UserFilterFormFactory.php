<?php

namespace Application\Factory\Form;

use Application\Form\User\UserFilterForm;
use Application\Model\Options\PositionOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserFilterFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new UserFilterForm(
            $container->get(PositionOptions::class),
        );
    }
}
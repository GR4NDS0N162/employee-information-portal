<?php

namespace Application\Factory\Form;

use Application\Form\Admin\AdminFilterForm;
use Application\Model\Options\PositionOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AdminFilterFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new AdminFilterForm(
            $container->get(PositionOptions::class),
        );
    }
}
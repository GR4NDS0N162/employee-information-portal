<?php

namespace Application\Factory\Form;

use Application\Form\Messenger\DialogFilterForm;
use Application\Model\Options\PositionOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DialogFilterFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new DialogFilterForm(
            $container->get(PositionOptions::class),
        );
    }
}
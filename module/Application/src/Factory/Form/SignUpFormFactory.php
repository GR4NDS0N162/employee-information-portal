<?php

namespace Application\Factory\Form;

use Application\Form\Login\SignUpForm;
use Application\Model\Options\PositionOptions;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SignUpFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new SignUpForm(
            $container->get(PositionOptions::class),
        );
    }
}
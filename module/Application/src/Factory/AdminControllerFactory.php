<?php

namespace Application\Factory;

use Application\Controller\AdminController;
use Application\Form\PositionForm;
use Application\Form\UserForm;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AdminControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get('FormElementManager');

        return new AdminController(
            $formManager->get(PositionForm::class),
            $formManager->get(UserForm::class),
        );
    }
}
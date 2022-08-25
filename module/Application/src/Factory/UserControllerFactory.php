<?php

namespace Application\Factory;

use Application\Controller\UserController;
use Application\Form\ProfileForm;
use Application\Form\ViewProfileForm;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get('FormElementManager');

        return new UserController(
            $formManager->get(ProfileForm::class),
            $formManager->get(ViewProfileForm::class),
        );
    }
}
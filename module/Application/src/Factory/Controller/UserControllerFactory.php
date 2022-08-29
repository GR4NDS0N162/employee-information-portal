<?php

namespace Application\Factory\Controller;

use Application\Controller\UserController;
use Application\Form\User\ChangePasswordForm;
use Application\Form\User\ProfileForm;
use Application\Form\User\UserFilterForm;
use Application\Form\User\ViewProfileForm;
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
            $formManager->get(UserFilterForm::class),
            $formManager->get(ChangePasswordForm::class),
        );
    }
}
<?php

namespace Home\Factory;

use Home\Controller\HomeController;
use Home\Form\LoginForm;
use Home\Form\RecoverForm;
use Home\Form\SignUpForm;
use Home\Model\EmailRepositoryInterface;
use Home\Model\PositionRepositoryInterface;
use Home\Model\UserCommandInterface;
use Home\Model\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class HomeControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get('FormElementManager');
        return new HomeController(
            $container->get(PositionRepositoryInterface::class),
            $container->get(UserRepositoryInterface::class),
            $container->get(EmailRepositoryInterface::class),
            $container->get(UserCommandInterface::class),
            $formManager->get(LoginForm::class),
            $formManager->get(SignUpForm::class),
            $formManager->get(RecoverForm::class),
        );
    }
}

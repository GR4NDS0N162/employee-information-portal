<?php

namespace Application\Factory\Controller;

use Application\Controller\AdminController;
use Application\Form\Admin\AdminFilterForm;
use Application\Form\Admin\PositionForm;
use Application\Form\Admin\UserForm;
use Application\Model\Command\PositionCommandInterface;
use Application\Model\Command\UserCommandInterface;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\StatusRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Session\Container as SessionContainer;

class AdminControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        /** @var ContainerInterface $formManager */
        $formManager = $container->get('FormElementManager');

        return new AdminController(
            $formManager->get(PositionForm::class),
            $formManager->get(UserForm::class),
            $formManager->get(AdminFilterForm::class),
            $container->get(UserRepositoryInterface::class),
            $container->get(StatusRepositoryInterface::class),
            $container->get(PositionRepositoryInterface::class),
            $container->get(UserCommandInterface::class),
            $container->get(PositionCommandInterface::class),
            $container->get(SessionContainer::class),
        );
    }
}
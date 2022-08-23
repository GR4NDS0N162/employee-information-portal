<?php

namespace User\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\ProfileController;
use User\Form\ProfileInfoForm;
use User\Model\EmailRepositoryInterface;
use User\Model\PhoneRepositoryInterface;
use User\Model\ProfileCommandInterface;
use User\Model\ProfileRepositoryInterface;

class ProfileControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get('FormElementManager');

        return new ProfileController(
            $container->get(PhoneRepositoryInterface::class),
            $container->get(EmailRepositoryInterface::class),
            $container->get(ProfileRepositoryInterface::class),
            $formManager->get(ProfileInfoForm::class),
            $container->get(ProfileCommandInterface::class),
        );
    }
}

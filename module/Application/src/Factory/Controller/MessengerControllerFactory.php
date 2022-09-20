<?php

namespace Application\Factory\Controller;

use Application\Controller\MessengerController;
use Application\Form\Messenger\DialogFilterForm;
use Application\Form\Messenger\NewMessageForm;
use Application\Model\Command\MessageCommandInterface;
use Application\Model\Repository\DialogRepositoryInterface;
use Application\Model\Repository\MessageRepositoryInterface;
use Application\Model\Repository\PositionRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MessengerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        /** @var ContainerInterface $formManager */
        $formManager = $container->get('FormElementManager');

        return new MessengerController(
            $formManager->get(DialogFilterForm::class),
            $formManager->get(NewMessageForm::class),
            $container->get(DialogRepositoryInterface::class),
            $container->get(UserRepositoryInterface::class),
            $container->get(PositionRepositoryInterface::class),
            $container->get(MessageRepositoryInterface::class),
            $container->get(MessageCommandInterface::class),
        );
    }
}
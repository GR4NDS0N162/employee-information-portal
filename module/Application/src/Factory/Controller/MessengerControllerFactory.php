<?php

namespace Application\Factory\Controller;

use Application\Controller\MessengerController;
use Application\Form\Messenger\DialogFilterForm;
use Application\Form\Messenger\NewMessageForm;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MessengerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get('FormElementManager');

        return new MessengerController(
            $formManager->get(DialogFilterForm::class),
            $formManager->get(NewMessageForm::class),
        );
    }
}
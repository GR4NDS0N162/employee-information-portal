<?php

namespace Application;

use Laminas\EventManager\EventInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    ConfigProviderInterface,
    BootstrapListenerInterface
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getApplication();
        $app->getEventManager()->attach('render', [$this, 'registerJsonStrategy'], 100);
    }

    public function registerJsonStrategy(EventInterface $e)
    {
        $app = $e->getTarget();
        $locator = $app->getServiceManager();
        $view = $locator->get('Laminas\View\View');
        $jsonStrategy = $locator->get('ViewJsonStrategy');

        $jsonStrategy->attach($view->getEventManager(), 100);
    }
}

<?php

namespace Application;

use Laminas\Console\Adapter\AdapterInterface;
use Laminas\EventManager\EventInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\ConsoleUsageProviderInterface;

class Module implements
    ConfigProviderInterface,
    BootstrapListenerInterface,
    ConsoleUsageProviderInterface
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

    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            'send-emails' => 'Send an email to those who have unread messages',
        ];
    }
}

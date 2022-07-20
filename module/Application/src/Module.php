<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\AdminController;
use Application\Controller\LoginController;
use Application\Controller\PositionController;
use Laminas\ModuleManager\ModuleManager;
use Laminas\Mvc\MvcEvent;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function (MvcEvent $e) {
            $controller = $e->getTarget();

            switch (true) {
                case $controller instanceof LoginController:
                    $layout = 'layout/login';
                    break;
                default:
                    $layout = 'layout/layout';
                    break;
            }

            $controller->layout($layout);

            switch (true) {
                case $controller instanceof AdminController:
                case $controller instanceof PositionController:
                    $navbar = 'Laminas\Navigation\Admin';
                    break;
                default:
                    $navbar = 'Laminas\Navigation\Default';
                    break;
            }

            $viewModel = $e->getViewModel();
            $viewModel->setVariable('navbar', $navbar);
        }, 100);
    }
}

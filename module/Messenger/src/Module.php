<?php
declare(strict_types=1);

namespace Messenger;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Traversable;

class Module implements ConfigProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}

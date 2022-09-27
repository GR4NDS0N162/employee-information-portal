<?php

namespace Application;

use Laminas\Session\Container as SessionContainer;
use Laminas\Session\Storage\SessionArrayStorage;

return [
    'service_manager'    => include __DIR__ . '/service_manager.php',
    'form_elements'      => include __DIR__ . '/form_elements.php',
    'router'             => include __DIR__ . '/router.php',
    'navigation'         => include __DIR__ . '/navigation.php',
    'controllers'        => include __DIR__ . '/controllers.php',
    'view_manager'       => include __DIR__ . '/view_manager.php',
    'view_helpers'       => include __DIR__ . '/view_helpers.php',
    'session_containers' => [
        SessionContainer::class,
    ],
    'session_storage'    => [
        'type' => SessionArrayStorage::class,
    ],
    'session_config'     => [
        'gc_maxlifetime' => 7200,
    ],
];

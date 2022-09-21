<?php

namespace Application;

return [
    'default' => [
        [
            'label' => 'Profile',
            'route' => 'user/view-profile',
            'pages' => [
                [
                    'label' => 'View',
                    'route' => 'user/view-profile',
                ],
                [
                    'label' => 'Edit',
                    'route' => 'user/edit-profile',
                ],
            ],
        ],
        [
            'label' => 'Users',
            'route' => 'user/view-user-list',
        ],
        [
            'label' => 'Dialogs',
            'route' => 'user/view-dialog-list',
        ],
    ],
    'admin'   => [
        [
            'label' => 'Profile',
            'route' => 'user/view-profile',
            'pages' => [
                [
                    'label' => 'View',
                    'route' => 'user/view-profile',
                ],
                [
                    'label' => 'Edit',
                    'route' => 'user/edit-profile',
                ],
            ],
        ],
        [
            'label' => 'Users',
            'route' => 'user/view-user-list',
        ],
        [
            'label' => 'Dialogs',
            'route' => 'user/view-dialog-list',
        ],
        [
            'label' => 'For admins',
            'route' => 'admin/view-user-list',
            'pages' => [
                [
                    'label' => 'Users',
                    'route' => 'admin/view-user-list',
                ],
                [
                    'label' => 'Positions',
                    'route' => 'admin/edit-position',
                ],
            ],
        ],
    ],
];
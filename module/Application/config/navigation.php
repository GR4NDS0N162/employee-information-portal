<?php

namespace Application;

return [
    'default' => [
        [
            'label' => 'Профиль',
            'route' => 'user/view-profile',
            'pages' => [
                [
                    'label' => 'Просмотр',
                    'route' => 'user/view-profile',
                ],
                [
                    'label' => 'Редактирование',
                    'route' => 'user/edit-profile',
                ],
            ],
        ],
        [
            'label' => 'Пользователи',
            'route' => 'user/view-user-list',
        ],
        [
            'label' => 'Диалоги',
            'route' => 'user/view-dialog-list',
        ],
    ],
    'admin'   => [
        [
            'label' => 'Профиль',
            'route' => 'user/view-profile',
            'pages' => [
                [
                    'label' => 'Просмотр',
                    'route' => 'user/view-profile',
                ],
                [
                    'label' => 'Редактирование',
                    'route' => 'user/edit-profile',
                ],
            ],
        ],
        [
            'label' => 'Пользователи',
            'route' => 'user/view-user-list',
        ],
        [
            'label' => 'Диалоги',
            'route' => 'user/view-dialog-list',
        ],
        [
            'label' => 'Администраторам',
            'route' => 'admin/view-user-list',
            'pages' => [
                [
                    'label' => 'Пользователи',
                    'route' => 'admin/view-user-list',
                ],
                [
                    'label' => 'Должности',
                    'route' => 'admin/edit-position',
                ],
            ],
        ],
    ],
];
<?php

namespace Application\Form\Options;

class YesNoOptions
{
    public static function getActiveOptions()
    {
        return [
            null => 'Не выбран',
            1    => [
                'value'    => '1',
                'label'    => 'Да',
                'selected' => 'selected',
            ],
            2    => 'Нет',
        ];
    }

    public static function getAdminOptions()
    {
        return [
            null => [
                'label'    => 'Не выбран',
                'selected' => 'selected',
            ],
            1    => 'Да',
            2    => 'Нет',
        ];
    }
}
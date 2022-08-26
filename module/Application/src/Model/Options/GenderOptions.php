<?php

namespace Application\Model\Options;

class GenderOptions
{
    public static function getOptions()
    {
        return [
            null => [
                'label'    => 'Не выбран',
                'selected' => 'selected',
            ],
            1    => 'Мужской',
            2    => 'Женский',
        ];
    }
}
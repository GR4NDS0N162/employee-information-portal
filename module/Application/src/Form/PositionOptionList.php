<?php

declare(strict_types=1);

namespace Application\Form;

class PositionOptionList
{
    public static function getList(): array
    {
        return [
            '1' => 'Уборщик',
            '2' => 'Фасовщик',
            '3' => 'Менеджер',
            '4' => 'Швейцар',
            '5' => 'Шеф',
            '6' => 'Экономист',
            '7' => 'Электрик',
            '8' => 'Юрист',
        ];
    }

    public static function getEnabledList(): array
    {
        return [
            null => [
                'label'    => 'Не выбрана',
                'selected' => 'selected',
            ],
            '1'  => 'Уборщик',
            '2'  => 'Фасовщик',
            '3'  => 'Менеджер',
            '4'  => 'Швейцар',
            '5'  => 'Шеф',
            '6'  => 'Экономист',
            '7'  => 'Электрик',
            '8'  => 'Юрист',
        ];
    }

    public static function getDisabledList(): array
    {
        return [
            null => [
                'label'    => 'Не выбрана',
                'disabled' => 'disabled',
                'selected' => 'selected',
            ],
            '1'  => 'Уборщик',
            '2'  => 'Фасовщик',
            '3'  => 'Менеджер',
            '4'  => 'Швейцар',
            '5'  => 'Шеф',
            '6'  => 'Экономист',
            '7'  => 'Электрик',
            '8'  => 'Юрист',
        ];
    }
}

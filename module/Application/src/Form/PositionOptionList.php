<?php

declare(strict_types=1);

namespace Application\Form;

class PositionOptionList
{
    private const positions = [
        '1' => 'Уборщик',
        '2' => 'Фасовщик',
        '3' => 'Менеджер',
        '4' => 'Швейцар',
        '5' => 'Шеф',
        '6' => 'Экономист',
        '7' => 'Электрик',
        '8' => 'Юрист',
    ];

    public static function getList(): array
    {
        return self::positions;
    }

    public static function getEnabledList(): array
    {
        return array_merge([
            null => [
                'label'    => 'Не выбрана',
                'selected' => 'selected',
            ],
        ], self::positions);
    }

    public static function getDisabledList(): array
    {
        return array_merge([
            null => [
                'label'    => 'Не выбрана',
                'disabled' => 'disabled',
                'selected' => 'selected',
            ],
        ], self::positions);
    }
}

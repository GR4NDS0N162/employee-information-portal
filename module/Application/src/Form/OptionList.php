<?php

namespace Application\Form;

class OptionList
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

    private const genders = [
        null => [
            'label'    => 'Не выбран',
            'selected' => 'selected',
        ],
        1    => 'Мужской',
        2    => 'Женский',
    ];

    public static function getGenderList()
    {
        return self::genders;
    }

    public static function getActiveFilterOptions()
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

    public static function getAdminFilterOptions()
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

    public static function getPositionList(): array
    {
        return self::positions;
    }

    public static function getEnabledPositionList(): array
    {
        return array_merge([
            null => [
                'label'    => 'Не выбрана',
                'selected' => 'selected',
            ],
        ], self::positions);
    }

    public static function getDisabledPositionList(): array
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

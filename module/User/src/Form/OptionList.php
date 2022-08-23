<?php

namespace User\Form;

class OptionList
{
    private const genders = [
        null => 'Не выбран',
        1    => 'Мужской',
        2    => 'Женский',
    ];

    /**
     * @return array
     */
    public static function getGenderOptions()
    {
        return self::genders;
    }
}

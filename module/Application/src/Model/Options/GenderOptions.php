<?php

namespace Application\Model\Options;

class GenderOptions
{
    /**
     * @return string[]
     */
    public static function getOptions()
    {
        return [
            null => 'Не выбран',
            1    => 'Мужской',
            2    => 'Женский',
        ];
    }
}
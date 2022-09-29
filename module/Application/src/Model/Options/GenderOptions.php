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
            null => 'Not specified',
            1    => 'Male',
            2    => 'Female',
        ];
    }
}
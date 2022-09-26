<?php

namespace Application\Helper;

class ConfigHelper
{
    public static function filterEmpty(array $array): array
    {
        foreach ($array as $key => & $value) {
            if (is_array($value)) {
                $value = ConfigHelper::filterEmpty($value);
            }
            if (!$value) {
                unset($array[$key]);
            }
        }
        unset($value);

        return $array;
    }
}
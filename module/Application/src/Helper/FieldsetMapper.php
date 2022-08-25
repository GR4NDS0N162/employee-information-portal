<?php

namespace Application\Helper;

use Laminas\Form\FieldsetInterface;

class FieldsetMapper
{
    public const KEY = 'delimiter_class';

    public static function setMapping(FieldsetInterface $fieldset, array $map)
    {
        foreach ($map as $name => $class) {
            if ($fieldset->has($name)) {
                $fieldset->get($name)->setAttribute(self::KEY, $class);
            }
        }
    }
}
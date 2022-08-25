<?php

namespace Application\Helper;

use Laminas\Form\FieldsetInterface;

class FieldsetMapper
{
    public static function setMapping(FieldsetInterface $fieldset, array $map)
    {
        foreach ($map as $name => $class) {
            if ($fieldset->has($name)) {
                $fieldset->get($name)->setAttribute('delimiter_class', $class);
            }
        }
    }
}
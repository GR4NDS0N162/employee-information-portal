<?php

namespace Application\Form;

use Laminas\Form\FieldsetInterface;

class FieldsetMapper
{
    /**
     * @param $fieldset FieldsetInterface
     * @param $map array
     * @return void
     */
    public static function setMapping($fieldset, $map)
    {
        foreach ($map as $name => $class) {
            if ($fieldset->has($name)) {
                $fieldset->get($name)->setAttribute('delimiter_class', $class);
            }
        }
    }
}
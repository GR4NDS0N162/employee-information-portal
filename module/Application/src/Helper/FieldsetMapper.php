<?php

namespace Application\Helper;

use Laminas\Form\Element\Collection;
use Laminas\Form\ElementInterface;
use Laminas\Form\FieldsetInterface;

class FieldsetMapper
{
    public const KEY = 'delimiter_class';

    /**
     * @param ElementInterface $element
     * @param string|array     $config
     *
     * @return void
     */
    public static function setAttributes(ElementInterface $element, $config)
    {
        if (empty($config))
            return;

        if (is_string($config)) {
            $element->setAttribute(self::KEY, $config);
            return;
        }

        if (is_string($config['value']) and !empty($config['value']))
            $element->setAttribute(self::KEY, $config['value']);

        if (($element instanceof Collection) and !empty($config['target_element'])) {
            self::setAttributes($element->getTargetElement(), $config['target_element']);
            return;
        }

        if (($element instanceof FieldsetInterface) and is_array($config['children'])) {
            foreach ($config['children'] as $childName => $childConfig) {
                if ($element->has($childName)) {
                    self::setAttributes($element->get($childName), $childConfig);
                }
            }
        }
    }
}
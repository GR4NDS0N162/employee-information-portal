<?php

namespace Application\Form;

use Laminas\Form\Element\Number;
use Laminas\Form\Fieldset;

class AgeFilterFieldset extends Fieldset
{
    public const DEFAULT_NAME = 'age';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->add([
            'name'       => 'min',
            'type'       => Number::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 1,
            ],
            'options'    => [
                'label' => 'От',
            ],
        ]);

        $this->add([
            'name'       => 'max',
            'type'       => Number::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 99,
            ],
            'options'    => [
                'label' => 'До',
            ],
        ]);

        $classMap = [
            'min' => 'col-6',
            'max' => 'col-6',
        ];

        foreach ($classMap as $name => $class)
            $this->get($name)->setAttribute('delimiter_class', $class);
    }
}

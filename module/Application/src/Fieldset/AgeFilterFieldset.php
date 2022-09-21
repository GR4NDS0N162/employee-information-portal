<?php

namespace Application\Fieldset;

use Laminas\Form\Element\Number;
use Laminas\Form\Fieldset;

class AgeFilterFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->add([
            'name'       => 'min',
            'type'       => Number::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 1,
            ],
            'options'    => [
                'label' => 'From',
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
                'label' => 'To',
            ],
        ]);
    }
}
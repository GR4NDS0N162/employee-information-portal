<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Number;
use Laminas\Form\Fieldset;

class AgeFilterFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('age');

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
    }
}

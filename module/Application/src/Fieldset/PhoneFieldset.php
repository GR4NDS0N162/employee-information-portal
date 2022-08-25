<?php

namespace Application\Fieldset;

use Laminas\Form\Element\Tel;
use Laminas\Form\Fieldset;

class PhoneFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'name'       => 'number',
            'type'       => Tel::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => '+7xxxxxxxxxx',
                'required'    => 'required',
                'pattern'     => '^\+7[0-9]{10}$',
            ],
        ]);
    }
}
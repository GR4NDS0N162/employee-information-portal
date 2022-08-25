<?php

namespace Application\Fieldset;

use Laminas\Form\Element\Email;
use Laminas\Form\Fieldset;

class EmailFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'name'       => 'address',
            'type'       => Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
        ]);
    }
}
<?php

namespace Application\Fieldset;

use Application\Model\Email;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;

class EmailFieldset extends Fieldset
{
    public function init()
    {
        $this->setHydrator(new ClassMethodsHydrator(false, true));
        $this->setObject(new Email(''));

        $this->add([
            'name'       => 'address',
            'type'       => Element\Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
        ]);
    }
}
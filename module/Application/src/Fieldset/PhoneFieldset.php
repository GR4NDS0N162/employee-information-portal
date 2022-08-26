<?php

namespace Application\Fieldset;

use Application\Model\Phone;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;

class PhoneFieldset extends Fieldset
{
    public function init()
    {
        $this->setHydrator(new ClassMethodsHydrator(false, true));
        $this->setObject(new Phone(''));

        $this->add([
            'name'       => 'number',
            'type'       => Element\Tel::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => '+7xxxxxxxxxx',
                'required'    => 'required',
                'pattern'     => '^\+7[0-9]{10}$',
            ],
        ]);

        $this->add(include __DIR__ . '/../ElementArray/DeleteButton.php');
    }
}
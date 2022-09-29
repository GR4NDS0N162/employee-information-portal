<?php

namespace Application\Fieldset;

use Application\Model\Entity\Phone;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class PhoneFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->setObject(new Phone());

        $this->add([
            'name'       => 'number',
            'type'       => Element\Tel::class,
            'attributes' => [
                'class'       => 'form-control validation-pattern-phone',
                'placeholder' => '+7xxxxxxxxxx',
                'required'    => 'required',
                'pattern'     => '^\+7[0-9]{10}$',
            ],
        ]);

        $this->add(include __DIR__ . '/../ElementArray/DeleteButton.php');
    }
}
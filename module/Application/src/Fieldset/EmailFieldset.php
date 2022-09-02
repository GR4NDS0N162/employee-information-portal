<?php

namespace Application\Fieldset;

use Application\Model\Entity\Email;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;

class EmailFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->setObject(new Email());

        $this->add([
            'name'       => 'address',
            'type'       => Element\Email::class,
            'attributes' => [
                'class'       => 'form-control validation-pattern-email',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
        ]);

        $this->add(include __DIR__ . '/../ElementArray/DeleteButton.php');
    }
}
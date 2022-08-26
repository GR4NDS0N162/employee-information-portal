<?php

namespace Application\Fieldset;

use Application\Model\Position;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;

class PositionFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->setHydrator(new ClassMethodsHydrator(false, true));
        $this->setObject(new Position(''));

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name'       => 'name',
            'type'       => Element\Text::class,
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
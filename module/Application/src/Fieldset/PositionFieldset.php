<?php

namespace Application\Fieldset;

use Application\Model\Entity\Position;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class PositionFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->setObject(new Position());

        $this->add([
            'name'       => 'name',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Уборщик',
                'required'    => 'required',
            ],
        ]);

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add(include __DIR__ . '/../ElementArray/DeleteButton.php');
    }
}
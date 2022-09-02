<?php

namespace Application\Fieldset;

use Application\Helper\FieldsetMapper;
use Application\Model\Entity\Position;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;

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
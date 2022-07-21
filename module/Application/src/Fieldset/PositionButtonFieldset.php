<?php

namespace Application\Fieldset;

use Laminas\Form\Element\Button;
use Laminas\Form\Fieldset;

class PositionButtonFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name'       => 'edit',
            'type'       => Button::class,
            'options'    => [
                'label' => 'edit'
            ],
            'attributes' => [
                'class' => 'btn btn-outline-warning',
            ],
        ]);

        $this->add([
            'name'       => 'delete',
            'type'       => Button::class,
            'options'    => [
                'label' => 'del'
            ],
            'attributes' => [
                'class' => 'btn btn-outline-danger',
            ],
        ]);
    }
}

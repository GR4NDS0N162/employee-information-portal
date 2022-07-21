<?php

namespace Application\Fieldset;

use Laminas\Form\Element\Text;
use Laminas\Form\Fieldset;

class PositionFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name'       => 'name',
            'type'       => Text::class,
            'attributes' => [
                'class'    => 'form-control',
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name'       => 'buttons',
            'type'       => PositionButtonFieldset::class,
            'attributes' => [
                'class' => 'btn-group',
            ],
        ]);
    }
}

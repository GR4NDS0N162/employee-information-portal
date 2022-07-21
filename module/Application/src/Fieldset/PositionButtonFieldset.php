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
            'name'       => 'delete',
            'type'       => Button::class,
            'options'    => [
                'label' => '<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title></title><g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"></line><line class="cls-1" x1="7" x2="25" y1="25" y2="7"></line></g></svg>'
            ],
            'attributes' => [
                'onClick' => 'delete_position(this)',
                'class' => 'btn btn-outline-danger',
            ],
        ]);
    }
}

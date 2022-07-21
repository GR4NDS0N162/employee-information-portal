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
                'label' => '<svg width="24" height="24" fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><title></title><g data-name="menu " id="menu_"><path d="M29,6H3A1,1,0,0,0,3,8H29a1,1,0,0,0,0-2Z"></path><path d="M3,17H16a1,1,0,0,0,0-2H3a1,1,0,0,0,0,2Z"></path><path d="M25,24H3a1,1,0,0,0,0,2H25a1,1,0,0,0,0-2Z"></path></g></svg>',
            ],
            'attributes' => [
                'class' => 'btn btn-outline-warning',
            ],
        ]);

        $this->add([
            'name'       => 'delete',
            'type'       => Button::class,
            'options'    => [
                'label' => '<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title></title><g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"></line><line class="cls-1" x1="7" x2="25" y1="25" y2="7"></line></g></svg>'
            ],
            'attributes' => [
                'class' => 'btn btn-outline-danger',
            ],
        ]);
    }
}

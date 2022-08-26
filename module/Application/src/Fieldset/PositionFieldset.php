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

        $this->add([
            'name'       => 'delete',
            'type'       => Element\Button::class,
            'attributes' => [
                'class' => 'btn btn-outline-danger',
            ],
            'options'    => [
                'label'         => '<svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px}</style></defs><title></title><g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"></line><line class="cls-1" x1="7" x2="25" y1="25" y2="7"></line></g></svg>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
    }
}
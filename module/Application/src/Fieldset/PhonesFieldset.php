<?php

namespace Application\Fieldset;

use Application\Form\FieldsetMapper;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Tel;
use Laminas\Form\Fieldset;

class PhonesFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'name'       => 'add',
            'type'       => Button::class,
            'attributes' => [
                'type'  => 'button',
                'class' => 'btn btn-outline-primary w-100',
            ],
            'options'    => [
                'label' => 'Добавить телефон',
            ],
        ]);

        $this->add([
            'name'       => 'list',
            'type'       => Collection::class,
            'attributes' => [
                'class' => 'row gy-3',
            ],
            'options'    => [
                'target_element'         => [
                    'type'       => Tel::class,
                    'attributes' => [
                        'class'       => 'form-control',
                        'placeholder' => '+7xxxxxxxxxx',
                        'required'    => 'required',
                        'pattern'     => '^\+7[0-9]{10}$',
                    ],
                ],
                'count'                  => 0,
                'allow_add'              => true,
                'allow_remove'           => true,
                'should_create_template' => true,
                'template_placeholder'   => '__index__',
            ],
        ]);

        FieldsetMapper::setMapping($this, [
            'add'  => 'col-12',
            'list' => 'col-12',
        ]);
    }
}
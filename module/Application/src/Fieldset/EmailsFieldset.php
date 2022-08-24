<?php

namespace Application\Fieldset;

use Application\Form\FieldsetMapper;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Email;
use Laminas\Form\Fieldset;

class EmailsFieldset extends Fieldset
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
                'label' => 'Добавить e-mail',
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
                    'type'       => Email::class,
                    'attributes' => [
                        'class'       => 'form-control',
                        'placeholder' => 'name@example.com',
                        'required'    => 'required',
                        'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
                    ],
                ],
                'count'                  => 1,
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
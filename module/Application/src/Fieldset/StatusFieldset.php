<?php

namespace Application\Fieldset;

use Laminas\Form\Element\Checkbox;
use Laminas\Form\Fieldset;

class StatusFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->add([
            'name'       => 'admin',
            'type'       => Checkbox::class,
            'attributes' => [
                'class' => 'form-check-input',
                'id'    => uniqid('checkbox_', true),
            ],
            'options'    => [
                'label'              => 'Администратор',
                'label_attributes'   => [
                    'class' => 'form-check-label',
                ],
                'use_hidden_element' => false,
            ],
        ]);

        $this->add([
            'name'       => 'active',
            'type'       => Checkbox::class,
            'attributes' => [
                'class' => 'form-check-input',
                'id'    => uniqid('checkbox_', true),
            ],
            'options'    => [
                'label'              => 'Активен',
                'label_attributes'   => [
                    'class' => 'form-check-label',
                ],
                'use_hidden_element' => false,
            ],
        ]);
    }
}

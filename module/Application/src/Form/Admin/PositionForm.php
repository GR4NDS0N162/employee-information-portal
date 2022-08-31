<?php

namespace Application\Form\Admin;

use Application\Fieldset\PositionListFieldset;
use Application\Helper\FieldsetMapper;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class PositionForm extends Form
{
    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row g-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'position-list',
            'type'       => PositionListFieldset::class,
            'attributes' => [
                'class' => 'row g-3 align-items-start',
            ],
            'options'    => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [
                'value' => 'Сохранить изменения',
                'class' => 'btn btn-outline-success w-100',
            ],
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'position-list' => [
                    'value'    => 'col-12',
                    'children' => [
                        'list' => [
                            'value'          => 'col-12',
                            'target_element' => 'col-12',
                        ],
                    ],
                ],
                'submit'        => 'col-12',
            ],
        ]);
    }
}
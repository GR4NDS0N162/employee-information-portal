<?php

namespace Application\Form\Admin;

use Application\Fieldset\PositionFieldset;
use Application\Helper\FieldsetMapper;
use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class PositionForm extends Form
{
    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row g-3');

        $this->add([
            'name'       => 'positions',
            'type'       => Collection::class,
            'attributes' => [
                'class' => 'row g-3',
            ],
            'options'    => [
                'label'                  => 'Должности',
                'count'                  => 0,
                'allow_add'              => true,
                'allow_remove'           => true,
                'should_create_template' => true,
                'template_placeholder'   => '__index__',
                'target_element'         => [
                    'type'       => PositionFieldset::class,
                    'attributes' => [
                        'class' => 'input-group',
                    ],
                ],
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
                'positions' => [
                    'value'          => 'col-12',
                    'target_element' => 'col-12',
                ],
                'submit'    => 'col-12',
            ],
        ]);
    }
}
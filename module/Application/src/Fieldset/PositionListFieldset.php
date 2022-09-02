<?php

namespace Application\Fieldset;

use Application\Model\Entity\PositionList;
use Laminas\Form\Element\Collection;
use Laminas\Form\Fieldset;

class PositionListFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $this->setObject(new PositionList());

        $this->add([
            'name'       => 'list',
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
    }
}
<?php

namespace Application\Fieldset;

use Application\Model\Entity\PositionList;
use Laminas\Form\Element\Collection;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;

class PositionListFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $object = new PositionList();
        $this->setObject($object);

        $hydrator = new ClassMethodsHydrator(true, true);
        $this->setHydrator($hydrator);

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
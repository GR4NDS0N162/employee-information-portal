<?php

declare(strict_types=1);

namespace Application\Form;

use Application\Fieldset\PositionFieldset;
use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\InputFilter\InputFilter;

class PositionForm extends Form
{
    public function __construct()
    {
        parent::__construct('position-form');

        $this->setAttribute('method', 'POST');
        $this->setHydrator(new ClassMethodsHydrator());
        $this->setInputFilter(new InputFilter());

        $this->add([
            'type'       => Collection::class,
            'name'       => 'positions',
            'attributes' => [
                'class' => 'row gy-3',
            ],
            'options'    => [
                'count'                  => 3,
                'should_create_template' => true,
                'allow_add'              => true,
                'allow_remove'           => true,
                'target_element'         => [
                    'type'       => PositionFieldset::class,
                    'attributes' => [
                        'class' => 'row gx-3',
                    ]
                ],
            ],
        ]);

        $this->add([
            'type' => Csrf::class,
            'name' => 'csrf',
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [
                'class' => 'btn btn-outline-success mt-3 w-100',
                'value' => 'Сохранить изменения',
            ],
        ]);
    }
}

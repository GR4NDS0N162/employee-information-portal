<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\Hydrator\ClassMethods as ClassMethodsHydrator;

class EditPositionForm extends Form
{
    public function __construct()
    {
        parent::__construct('edit_position');

        $this->setAttribute('method', 'POST');
        $this->setHydrator(new ClassMethodsHydrator());
        $this->setInputFilter(new InputFilter());

        $this->add([
            'type'    => Collection::class,
            'name'    => 'positions',
            'options' => [
                'label'                  => 'Должности',
                'count'                  => 3,
                'should_create_template' => true,
                'allow_add'              => true,
                'allow_remove'           => true,
                'target_element'         => [
                    'type' => PositionFieldset::class,
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
                'class' => 'btn btn-outline-success w-100',
                'value' => 'Сохранить изменения',
            ],
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Application\Form;

use Application\Entity\Position;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Text;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Hydrator\ClassMethods as ClassMethodsHydrator;

class PositionFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('category');

        $this->setHydrator(new ClassMethodsHydrator(false));
        $this->setObject(new Position());

        $this->setLabel('Должность');

        $this->add([
            'name'       => 'id',
            'type'       => Number::class,
//            'options'    => [
//                'label' => 'ID должности',
//            ],
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name'       => 'name',
            'type'       => Text::class,
//            'options'    => [
//                'label' => 'Название должности',
//            ],
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name'       => 'delete',
            'type'       => Button::class,
            'options'    => [
                'label' => 'Удалить должность',
            ],
            'attributes' => [
                'onClick' => 'delete_position(this)',
                'class'   => 'btn btn-outline-dander delete-position',
            ],
        ]);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required' => true,
            ],
            'id'   => [
                'required' => true,
            ],
        ];
    }
}

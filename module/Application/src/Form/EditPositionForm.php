<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPositionForm extends Form
{
    public function __construct()
    {
        parent::__construct('edit-position-form');

        $this->setAttribute('class', 'row gy-3');

        $this->add([
            'name' => 'add-button',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'button',
                'class' => 'btn btn-outline-primary w-100',
                'onclick' => 'add_position()',
            ],
            'options' => [
                'label' => 'Добавить телефон',
            ],
        ]);

        $this->add([
            'name' => 'positions',
            'type' => Element\Collection::class,
            'attributes' => [
                'class' => 'row g-3 collection-list',
            ],
            'options' => [
                'count' => 0,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'target_element' => [
                    'type' => Element\Text::class,
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => 'Уборщик',
                        'required' => 'required',
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'submit-button',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options' => [
                'label' => 'Сохранить изменения',
            ],
        ]);
    }
}

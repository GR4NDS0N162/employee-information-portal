<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPhoneForm extends Form
{
    public function __construct()
    {
        parent::__construct('edit-phone-form');

        $this->setAttribute('class', 'row gy-3');

        $this->add([
            'name' => 'add-button',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'button',
                'class' => 'btn btn-outline-primary w-100',
                'onclick' => 'add_phone()',
            ],
            'options' => [
                'label' => 'Добавить телефон',
            ],
        ]);

        $this->add([
            'name' => 'phones',
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
                    'type' => Element\Tel::class,
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => '+7(xxx)xxx-xx-xx',
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

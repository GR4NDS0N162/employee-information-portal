<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditEmailForm extends Form
{
    public function __construct()
    {
        parent::__construct('edit-email-form');

        $this->setAttribute('class', 'row gy-3');

        $this->add([
            'name' => 'add-button',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'button',
                'class' => 'btn btn-outline-primary w-100',
                'onclick' => 'add_email()',
            ],
            'options' => [
                'label' => 'Добавить e-mail',
            ],
        ]);

        $this->add([
            'name' => 'emails',
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
                    'type' => Element\Email::class,
                    'attributes' => [
                        'class' => 'form-control',
                        'placeholder' => 'name@example.com',
                        'required' => 'required',
                        'pattern' => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
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

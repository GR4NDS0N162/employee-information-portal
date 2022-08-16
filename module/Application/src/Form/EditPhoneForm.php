<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPhoneForm extends EditListForm
{
    public function __construct()
    {
        $this->list['options']['target_element'] = [
            'type'       => Element\Tel::class,
            'attributes' => [
                'class'       => 'form-control validation-pattern-phone',
                'placeholder' => '+7xxxxxxxxxx',
                'required'    => 'required',
                'pattern'     => '^\+7[0-9]{10}$',
            ],
        ];

        parent::__construct('edit-phone-form');

        $this->get('add-button')->setLabel('Добавить телефон');
    }
}

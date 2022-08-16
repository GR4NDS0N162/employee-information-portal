<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPositionForm extends EditListForm
{
    public function __construct()
    {
        $this->list['options']['target_element'] = [
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Уборщик',
                'required'    => 'required',
            ],
        ];

        parent::__construct('edit-position-form');

        $this->get('add-button')->setLabel('Добавить должность');
    }
}

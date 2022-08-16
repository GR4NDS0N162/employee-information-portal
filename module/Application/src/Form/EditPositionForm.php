<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPositionForm extends EditListForm
{
    public function __construct()
    {
        $this->addButton['options']['label'] = 'Добавить должность';

        $this->list['options']['target_element'] = [
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Уборщик',
                'required'    => 'required',
            ],
        ];

        parent::__construct('edit-position-form');
    }
}

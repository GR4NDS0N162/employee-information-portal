<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditEmailForm extends EditListForm
{
    public function __construct()
    {
        $this->addButton['options']['label'] = 'Добавить e-mail';

        $this->list['options']['count'] = 1;
        $this->list['options']['target_element'] = [
            'type' => Element\Email::class,
            'attributes' => [
                'class' => 'form-control validation-pattern-email',
                'placeholder' => 'name@example.com',
                'required' => 'required',
                'pattern' => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
        ];

        parent::__construct('edit-email-form');
    }
}

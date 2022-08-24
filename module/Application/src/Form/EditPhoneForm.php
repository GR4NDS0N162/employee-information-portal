<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPhoneForm extends EditListForm
{
    public const DEFAULT_NAME = 'edit-phone-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->get('add-button')->setLabel('Добавить телефон');

        $this->get('list')
            ->setTargetElement([
                'type'       => Element\Tel::class,
                'attributes' => [
                    'class'       => 'form-control validation-pattern-phone',
                    'placeholder' => '+7xxxxxxxxxx',
                    'required'    => 'required',
                    'pattern'     => '^\+7[0-9]{10}$',
                ],
            ]);
    }
}

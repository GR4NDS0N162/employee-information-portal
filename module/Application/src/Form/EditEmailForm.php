<?php

namespace Application\Form;

use Laminas\Form\Element;

class EditEmailForm extends EditListForm
{
    public const DEFAULT_NAME = 'edit-email-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->get('add-button')->setLabel('Добавить e-mail');

        $this->get('list')
            ->setCount(1)
            ->setTargetElement([
                'type'       => Element\Email::class,
                'attributes' => [
                    'class'       => 'form-control validation-pattern-email',
                    'placeholder' => 'name@example.com',
                    'required'    => 'required',
                    'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
                ],
            ]);
    }
}

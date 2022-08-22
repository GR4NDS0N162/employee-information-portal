<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditPositionForm extends EditListForm
{
    public const DEFAULT_NAME = 'edit-position-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->get('add-button')->setLabel('Добавить должность');

        $this->get('list')
            ->setTargetElement([
                'type'       => Element\Text::class,
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Уборщик',
                    'required'    => 'required',
                ],
            ]);
    }
}

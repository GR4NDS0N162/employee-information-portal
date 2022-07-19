<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Textarea;

class DialogForm extends ListForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name'       => 'fullname-phone',
            'type'       => Textarea::class,
            'attributes' => [
                'class'       => 'form-control resize-none',
                'rows'        => '2',
                'placeholder' => 'Иванов Иван Иванович, +79283627374',
            ],
            'options'    => [
                'label' => 'ФИО, телефон',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
    }
}

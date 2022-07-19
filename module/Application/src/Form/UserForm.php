<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Textarea;

class UserForm extends ListForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name'       => 'fullname-phone-email',
            'type'       => Textarea::class,
            'attributes' => [
                'class'       => 'form-control resize-none',
                'rows'        => '3',
                'placeholder' => 'Иванов Иван Иванович, +79283627374, example@name.com',
            ],
            'options'    => [
                'label'            => 'ФИО, телефон, email',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
    }
}

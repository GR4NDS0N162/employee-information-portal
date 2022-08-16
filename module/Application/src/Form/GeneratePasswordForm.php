<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class GeneratePasswordForm extends Form
{
    public function __construct()
    {
        parent::__construct('generate-password-form');

        $this->setAttribute('class', 'row gy-3');

        $this->add([
            'name'       => 'submit-button',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-outline-primary w-100',
            ],
            'options'    => [
                'label' => 'Сгенерировать пароль и отправить на почту',
            ],
        ]);
    }
}

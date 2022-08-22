<?php

namespace Home\Form;

use Laminas\Form\Element\Button;
use Laminas\Form\Element\Email;
use Laminas\Form\Form;

class RecoverForm extends Form
{
    public function init()
    {
        $this->add([
            'name'       => 'email',
            'type'       => Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
            'options'    => [
                'label'            => 'E-mail',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'submit-button',
            'type'       => Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-lg btn-outline-danger w-100',
            ],
            'options'    => [
                'label' => 'Восстановить',
            ],
        ]);
    }
}

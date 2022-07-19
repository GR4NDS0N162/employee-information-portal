<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class RecoverForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
            'class' => 'row gy-3 mb-3',
            'method' => 'post',
            'id' => 'recover-form',
            'novalidate' => 'novalidate',
        ];

        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'E-mail',
                'id' => 'email-field-recover',
                'required' => 'required',
                'pattern' => SignUpForm::emailPattern,
            ],
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'class' => 'btn btn-lg btn-outline-danger w-100',
                'value' => 'Восстановить',
            ],
        ]);
    }
}

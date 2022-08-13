<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class ChangePasswordForm extends SetPasswordForm
{
    public function __construct()
    {
        $this->submitButton['options']['label'] = 'Изменить пароль';

        parent::__construct('change-password-form');

        $this->add([
            'name' => 'current-password',
            'type' => Element\Password::class,
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'qwerty123',
                'required' => 'required',
                'autocomplete' => 'current-password',
            ],
            'options' => [
                'label' => 'Текущий пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ], ['priority' => 100]);
    }
}

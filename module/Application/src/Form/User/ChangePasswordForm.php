<?php

namespace Application\Form\User;

use Application\Fieldset\ChangePasswordFieldset;
use Application\Helper\FieldsetMapper;
use Laminas\Form\Element;
use Laminas\Form\Form;

class ChangePasswordForm extends Form
{
    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'change_password',
            'type'       => ChangePasswordFieldset::class,
            'attributes' => [
                'class' => 'row g-3 align-items-start',
            ],
            'options'    => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'name'       => 'submit_button',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Изменить пароль',
            ],
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'change_password' => [
                    'value'    => 'col-12',
                    'children' => [
                        'id'               => 'd-none',
                        'current_password' => 'col-12',
                        'new_password'     => 'col-12',
                        'password_check'   => 'col-12',
                    ],
                ],
                'submit_button'   => 'col-12',
            ],
        ]);
    }
}

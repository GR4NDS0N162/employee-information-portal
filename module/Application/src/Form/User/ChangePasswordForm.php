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
            'name'       => 'changePassword',
            'type'       => ChangePasswordFieldset::class,
            'attributes' => [
                'class' => 'row g-3 align-items-start',
            ],
            'options'    => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'name'       => 'submitButton',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Change your password',
            ],
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'changePassword' => [
                    'value'    => 'col-12',
                    'children' => [
                        'id'              => 'd-none',
                        'currentPassword' => 'col-12',
                        'newPassword'     => 'col-12',
                        'passwordCheck'   => 'col-12',
                    ],
                ],
                'submitButton'   => 'col-12',
            ],
        ]);
    }
}

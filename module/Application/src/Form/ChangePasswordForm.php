<?php

namespace Application\Form;

use Application\Helper\FieldsetMapper;
use Laminas\Form\Element;

class ChangePasswordForm extends SetPasswordForm
{
    public const DEFAULT_NAME = 'change-password-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->add([
            'name'       => 'current-password',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'        => 'form-control',
                'placeholder'  => 'qwerty123',
                'required'     => 'required',
                'autocomplete' => 'current-password',
            ],
            'options'    => [
                'label'            => 'Текущий пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ], [
            'priority' => 100,
        ]);

        $this->get('submit-button')->setLabel('Изменить пароль');

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'current-password' => 'col-12',
                'new-password'     => 'col-12',
                'password-check'   => 'col-12',
                'submit-button'    => 'col-12',
            ],
        ]);
    }
}

<?php

namespace Application\Form\Login;

use Application\Fieldset\ProfileFieldset;
use Application\Helper\FieldsetMapper;
use Laminas\Form\Element;
use Laminas\Form\Form;

class LoginForm extends Form
{
    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'email',
            'type'       => Element\Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
            'options'    => [
                'label'            => 'E-mail',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'currentPassword',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
            ],
            'options'    => [
                'label'            => 'Пароль',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'submitButton',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-lg btn-outline-primary w-100',
            ],
            'options'    => [
                'label' => 'Войти',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'email'           => 'col-12',
                'currentPassword' => 'col-12',
                'submitButton'    => 'col-12',
            ],
        ]);
    }
}
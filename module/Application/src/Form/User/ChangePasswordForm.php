<?php

namespace Application\Form\User;

use Application\Helper\FieldsetMapper;
use Application\Model\Entity\User;
use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\Hydrator\ClassMethodsHydrator;

class ChangePasswordForm extends Form
{
    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->setHydrator(new ClassMethodsHydrator(false, true));
        $this->setObject(new User());

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

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
        ]);

        $this->add([
            'name'       => 'new-password',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'        => 'form-control',
                'placeholder'  => 'qwerty123',
                'required'     => 'required',
                'autocomplete' => 'new-password',
                'minlength'    => 8,
                'maxlength'    => 32,
                'pattern'      => '^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$',
            ],
            'options'    => [
                'label'            => 'Новый пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'password-check',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
                'pattern'     => '',
            ],
            'options'    => [
                'label'            => 'Подтверждение пароля',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'submit-button',
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
                'id'               => 'd-none',
                'current-password' => 'col-12',
                'new-password'     => 'col-12',
                'password-check'   => 'col-12',
                'submit-button'    => 'col-12',
            ],
        ]);
    }
}

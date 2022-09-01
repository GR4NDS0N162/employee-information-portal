<?php

namespace Application\Fieldset;

use Application\Model\Entity\ChangePassword;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Password;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;

class ChangePasswordFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $object = new ChangePassword();
        $this->setObject($object);

        $hydrator = new ClassMethodsHydrator(true, true);
        $this->setHydrator($hydrator);

        $this->add([
            'name' => 'id',
            'type' => Hidden::class,
        ]);

        $this->add([
            'name'       => 'currentPassword',
            'type'       => Password::class,
            'attributes' => [
                'class'        => 'form-control',
                'placeholder'  => 'qwerty123',
                'required'     => 'required',
                'maxlength'    => 32,
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
            'name'       => 'newPassword',
            'type'       => Password::class,
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
            'name'       => 'passwordCheck',
            'type'       => Password::class,
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
    }
}
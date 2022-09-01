<?php

namespace Application\Fieldset;

use Application\Helper\FieldsetMapper;
use Application\Model\Entity\ChangePassword;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Password;
use Laminas\Form\Fieldset;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;

class ChangePasswordFieldset extends Fieldset
{
    public function init()
    {
        parent::init();

        $object = new ChangePassword();
        $this->setObject($object);

        $hydrator = new ClassMethodsHydrator(true, true);
        FieldsetMapper::setStrategies($hydrator, [
            'id'               => new NullableStrategy(ScalarTypeStrategy::createToInt(), true),
            'current_password' => ScalarTypeStrategy::createToString(),
            'new_password'     => ScalarTypeStrategy::createToString(),
            'password_check'   => ScalarTypeStrategy::createToString(),
        ]);
        $this->setHydrator($hydrator);

        $this->add([
            'name' => 'id',
            'type' => Hidden::class,
        ]);

        $this->add([
            'name'       => 'current_password',
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
            'name'       => 'new_password',
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
            'name'       => 'password_check',
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
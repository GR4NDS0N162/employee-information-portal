<?php

namespace Application\Fieldset;

use Application\Model\Options\PositionOptions;
use Application\Model\User;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;

class UserFieldset extends ProfileFieldset
{
    public function init()
    {
        parent::init();

        $this->setObject(new User());

        $this->setPriority('emails', -100);
        $this->setPriority('phones', -100);

        $this->add([
            'name'       => 'positionId',
            'type'       => Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => PositionOptions::getOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'type'       => Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
                'minlength'   => 8,
                'maxlength'   => 32,
                'pattern'     => '^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$',
            ],
            'options'    => [
                'label'            => 'Пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'status',
            'type'       => StatusFieldset::class,
            'attributes' => [
                'class' => 'row gy-1',
            ],
        ]);
    }
}
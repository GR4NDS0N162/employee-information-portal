<?php

namespace Application\Form;

use Application\Form\Options\GenderOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class EditProfileForm extends Form
{
    public const DEFAULT_NAME = 'edit-profile-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row g-3');

        $this->add([
            'name'       => 'photo',
            'type'       => Element\File::class,
            'attributes' => [
                'class'  => 'form-control',
                'accept' => 'image/*',
            ],
            'options'    => [
                'label'            => 'Фото',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'surname',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Иванов',
            ],
            'options'    => [
                'label'            => 'Фамилия',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'name',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Иван',
            ],
            'options'    => [
                'label'            => 'Имя',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'patronymic',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Иванович',
            ],
            'options'    => [
                'label'            => 'Отчество',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'gender',
            'type'       => Element\Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Пол',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => GenderOptions::getOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'birthday',
            'type'       => Element\Date::class,
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'            => 'Дата рождения',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'skype',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'ivanivanov',
            ],
            'options'    => [
                'label'            => 'Skype',
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
                'label' => 'Сохранить изменения',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        $classMap = [
            'photo' => 'col-12',

            'surname'    => 'col-12 col-lg-4',
            'name'       => 'col-12 col-sm-6 col-lg-4',
            'patronymic' => 'col-12 col-sm-6 col-lg-4',

            'gender'   => 'col-12 col-sm-6 col-lg-4',
            'birthday' => 'col-12 col-sm-6 col-lg-4',

            'skype' => 'col-12 col-lg-4',

            'submit-button' => 'col-12',
        ];

        foreach ($classMap as $name => $class)
            $this->get($name)->setAttribute('delimiter_class', $class);
    }
}

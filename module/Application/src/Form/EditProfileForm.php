<?php

declare(strict_types=1);

namespace Application\Form;

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
                'options'          => [
                    null => [
                        'label'    => 'Не выбран',
                        'selected' => 'selected',
                    ],
                    '1'  => 'Мужской',
                    '2'  => 'Женский',
                ],
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
    }
}

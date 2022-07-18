<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Date;
use Laminas\Form\Element\File;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class ProfileForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
            'class'  => 'row g-3',
            'method' => 'post',
        ];

        $this->add([
            'name'       => 'photo',
            'type'       => File::class,
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'           => 'Фото',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'surname',
            'type'       => Text::class,
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label' => 'Фамилия',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'name',
            'type'       => Text::class,
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label' => 'Имя',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'patronymic',
            'type'       => Text::class,
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label' => 'Отчество',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'gender',
            'type'       => Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'   => 'Пол',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options' => [
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
            'type'       => Date::class,
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label' => 'Дата рождения',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'skype',
            'type'       => Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'ivanivanov',
            ],
            'options'    => [
                'label' => 'Отчество',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [
                'class' => 'btn btn-outline-success w-100',
                'value' => 'Сохранить изменения',
            ],
        ]);
    }
}

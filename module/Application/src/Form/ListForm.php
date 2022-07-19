<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Number;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class ListForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
            'class'  => 'row g-3',
            'method' => 'post',
        ];

        $this->add([
            'name'       => 'position',
            'type'       => Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => [
                    null => [
                        'label'    => 'Не выбрана',
                        'selected' => 'selected',
                    ],
                    '1'  => 'Уборщик',
                    '2'  => 'Фасовщик',
                    '3'  => 'Менеджер',
                    '4'  => 'Швейцар',
                    '5'  => 'Шеф',
                    '6'  => 'Экономист',
                    '7'  => 'Электрик',
                    '8'  => 'Юрист',
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
            'name'       => 'min-age',
            'type'       => Number::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => '1',
                'min'         => '1',
                'max'         => '100',
            ],
            'options'    => [
                'label'            => 'От',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'max-age',
            'type'       => Number::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => '100',
                'min'         => '1',
                'max'         => '100',
            ],
            'options'    => [
                'label'            => 'До',
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
                'value' => 'Применить фильтры',
            ],
        ]);
    }
}

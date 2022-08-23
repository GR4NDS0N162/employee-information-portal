<?php

namespace User\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class ProfileInfoForm extends Form
{
    public const DEFAULT_LABEL_ATTRIBUTES = [
        'class' => 'form-label',
    ];

    private $classMap = [
        'image'         => 'col-12',
        'surname'       => 'col-12 col-lg-4',
        'name'          => 'col-12 col-sm-6 col-lg-4',
        'patronymic'    => 'col-12 col-sm-6 col-lg-4',
        'gender'        => 'col-12 col-sm-6 col-lg-4',
        'birthday'      => 'col-12 col-sm-6 col-lg-4',
        'skype'         => 'col-12 col-lg-4',
        'submit-button' => 'col-12',
    ];

    public function init()
    {
        $this->setAttribute('class', 'row g-3');

        $this->add([
            'name'       => 'image',
            'type'       => Element\File::class,
            'attributes' => [
                'class'  => 'form-control',
                'accept' => 'image/*',
            ],
            'options'    => [
                'label'            => 'Фото',
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
                'options'          => OptionList::getGenderOptions(),
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
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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

        foreach ($this->classMap as $name => $class)
            $this->get($name)->setAttribute('delimiter_class', $class);
    }
}

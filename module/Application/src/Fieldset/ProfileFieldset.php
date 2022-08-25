<?php

namespace Application\Fieldset;

use Application\Form\FieldsetMapper;
use Application\Form\Options\GenderOptions;
use Laminas\Form\Element;
use Laminas\Form\Element\Email;
use Laminas\Form\Fieldset;

class ProfileFieldset extends Fieldset
{
    public const DEFAULT_LABEL_ATTRIBUTES = [
        'class' => 'form-label',
    ];

    public function init()
    {
        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

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
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Пол',
                'label_attributes' => self::DEFAULT_LABEL_ATTRIBUTES,
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
            'name'       => 'emails',
            'type'       => Element\Collection::class,
            'attributes' => [
                'class' => 'row gy-3',
            ],
            'options'    => [
                'count'                  => 1,
                'allow_add'              => true,
                'allow_remove'           => true,
                'should_create_template' => true,
                'template_placeholder'   => '__index__',
                'target_element'         => [
                    'type'       => EmailFieldset::class,
                    'attributes' => [
                        'class' => 'row g-3',
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'phones',
            'type'       => Element\Collection::class,
            'attributes' => [
                'class' => 'row gy-3',
            ],
            'options'    => [
                'count'                  => 0,
                'allow_add'              => true,
                'allow_remove'           => true,
                'should_create_template' => true,
                'template_placeholder'   => '__index__',
                'target_element'         => [
                    'type'       => PhoneFieldset::class,
                    'attributes' => [
                        'class' => 'row g-3',
                    ],
                ],
            ],
        ]);

        FieldsetMapper::setMapping($this, [
            'id'         => 'col-12',
            'image'      => 'col-12',
            'surname'    => 'col-12',
            'name'       => 'col-12',
            'patronymic' => 'col-12',
            'gender'     => 'col-12',
            'birthday'   => 'col-12',
            'skype'      => 'col-12',
            'emails'     => 'col-12',
            'phones'     => 'col-12',
        ]);
    }
}
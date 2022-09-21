<?php

namespace Application\Fieldset;

use Application\Model\Entity\Profile;
use Application\Model\Options\GenderOptions;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class ProfileFieldset extends Fieldset
{
    public const DEFAULT_LABEL_ATTRIBUTES = [
        'class' => 'form-label',
    ];

    public function init()
    {
        parent::init();

        $this->setObject(new Profile());

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name'       => 'imageFile',
            'type'       => Element\File::class,
            'attributes' => [
                'class'  => 'form-control',
                'accept' => 'image/*',
            ],
            'options'    => [
                'label'            => 'Image',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'surname',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Smith',
            ],
            'options'    => [
                'label'            => 'Surname',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'name',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Jerry',
            ],
            'options'    => [
                'label'            => 'Name',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'patronymic',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Richard',
            ],
            'options'    => [
                'label'            => 'Patronymic',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'gender',
            'type'       => Element\Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Gender',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
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
                'label'            => 'Date of birth',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
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
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'emails',
            'type'       => Element\Collection::class,
            'attributes' => [
                'class' => 'row g-3 non-empty-collection',
            ],
            'options'    => [
                'label'                  => 'Emails',
                'count'                  => 1,
                'allow_add'              => true,
                'allow_remove'           => true,
                'should_create_template' => true,
                'template_placeholder'   => '__index__',
                'target_element'         => [
                    'type'       => EmailFieldset::class,
                    'attributes' => [
                        'class' => 'input-group',
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'phones',
            'type'       => Element\Collection::class,
            'attributes' => [
                'class' => 'row g-3',
            ],
            'options'    => [
                'label'                  => 'Phone numbers',
                'count'                  => 0,
                'allow_add'              => true,
                'allow_remove'           => true,
                'should_create_template' => true,
                'template_placeholder'   => '__index__',
                'target_element'         => [
                    'type'       => PhoneFieldset::class,
                    'attributes' => [
                        'class' => 'input-group',
                    ],
                ],
            ],
        ]);
    }
}
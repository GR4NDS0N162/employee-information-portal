<?php

namespace Application\Form\Messenger;

use Application\Fieldset\AgeFilterFieldset;
use Application\Helper\FieldsetMapper;
use Application\Model\Options\GenderOptions;
use Application\Model\Options\PositionOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class DialogFilterForm extends Form
{
    public const DEFAULT_NAME = 'dialog-filter-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);
    }

    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row g-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'position',
            'type'       => Element\Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => PositionOptions::getEnabledOptions(),
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
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => GenderOptions::getOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'age',
            'type'       => AgeFilterFieldset::class,
            'attributes' => [
                'class' => 'row gx-3',
            ],
            'options'    => [
                'label' => 'Возраст',
            ],
        ]);

        $this->add([
            'name'       => 'fullname-phone',
            'type'       => Element\Textarea::class,
            'attributes' => [
                'class'       => 'form-control',
                'rows'        => '2',
                'placeholder' => 'Иванов Иван Иванович, +79283627374',
            ],
            'options'    => [
                'label'            => 'ФИО, телефон',
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
                'label' => 'Применить фильтры',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'position'       => 'col-12',
                'gender'         => 'col-12',
                'age'            => [
                    'value'    => 'col-12',
                    'children' => [
                        'min' => 'col-6',
                        'max' => 'col-6',
                    ],
                ],
                'fullname-phone' => 'col-12',
                'submit-button'  => 'col-12',
            ],
        ]);
    }
}

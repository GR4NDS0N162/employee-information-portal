<?php

namespace Application\Form\User;

use Application\Fieldset\AgeFilterFieldset;
use Application\Helper\FieldsetMapper;
use Application\Model\Options\GenderOptions;
use Application\Model\Options\PositionOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class UserFilterForm extends Form
{
    public const DEFAULT_NAME = 'user-filter-form';

    /**
     * @var PositionOptions
     */
    private $positionOptions;

    public function __construct(
        PositionOptions $positionOptions,
                        $name = self::DEFAULT_NAME
    ) {
        parent::__construct($name);

        $this->positionOptions = $positionOptions;

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
                'options'          => $this->positionOptions->getEnabledOptions(),
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
            'name'       => 'fullname-phone-email',
            'type'       => Element\Textarea::class,
            'attributes' => [
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'Иванов Иван Иванович, +79283627374, example@name.com',
            ],
            'options'    => [
                'label'            => 'ФИО, телефон, email',
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
                'position'             => 'col-12',
                'gender'               => 'col-12',
                'age'                  => [
                    'value'    => 'col-12',
                    'children' => [
                        'min' => 'col-6',
                        'max' => 'col-6',
                    ],
                ],
                'fullname-phone-email' => 'col-12',
                'submit-button'        => 'col-12',
            ],
        ]);
    }
}

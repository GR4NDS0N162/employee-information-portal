<?php

namespace Application\Form\Messenger;

use Application\Fieldset\AgeFilterFieldset;
use Application\Fieldset\ProfileFieldset;
use Application\Helper\FieldsetMapper;
use Application\Model\Options\GenderOptions;
use Application\Model\Options\PositionOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class DialogFilterForm extends Form
{
    private PositionOptions $positionOptions;

    public function __construct(
        PositionOptions $positionOptions,
                        $name = 'DialogFilterForm'
    ) {
        parent::__construct($name);

        $this->positionOptions = $positionOptions;
    }

    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row g-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'positionId',
            'type'       => Element\Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Position',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
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
                'label'            => 'Gender',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
                'options'          => GenderOptions::getOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'age',
            'type'       => AgeFilterFieldset::class,
            'attributes' => [
                'class' => 'row g-3',
            ],
            'options'    => [
                'label' => 'Age',
            ],
        ]);

        $this->add([
            'name'       => 'fullnamePhone',
            'type'       => Element\Textarea::class,
            'attributes' => [
                'class'       => 'form-control',
                'rows'        => '2',
                'placeholder' => 'Dwayne Douglas Johnson, +79283627374',
            ],
            'options'    => [
                'label'            => 'Fullname, phone number',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'submitButton',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Apply Filters',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'positionId'    => 'col-12',
                'gender'        => 'col-12',
                'age'           => [
                    'value'    => 'col-12',
                    'children' => [
                        'min' => 'col-12',
                        'max' => 'col-12',
                    ],
                ],
                'fullnamePhone' => 'col-12',
                'submitButton'  => 'col-12',
            ],
        ]);
    }
}

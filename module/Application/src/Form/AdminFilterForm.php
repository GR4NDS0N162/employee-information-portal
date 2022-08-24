<?php

namespace Application\Form;

use Application\Form\Options\YesNoOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class AdminFilterForm extends UserFilterForm
{
    public const DEFAULT_NAME = 'admin-filter-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->add([
            'name'       => 'active',
            'type'       => Element\Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Активен',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => YesNoOptions::getActiveOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'admin',
            'type'       => Element\Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Администратор',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => YesNoOptions::getAdminOptions(),
            ],
        ]);

        $classMap = [
            'active' => 'col-12',
            'admin'  => 'col-12',
        ];

        foreach ($classMap as $name => $class)
            $this->get($name)->setAttribute('delimiter_class', $class);
    }
}

<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class AdminFilterForm extends UserFilterForm
{
    public const DEFAULT_NAME = 'admin-filter-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->setPriority('submit-button', -100);

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
                'options'          => [
                    null => 'Не выбран',
                    '1'  => [
                        'value'    => '1',
                        'label'    => 'Да',
                        'selected' => 'selected',
                    ],
                    '2'  => 'Нет',
                ],
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
                'options'          => [
                    null => [
                        'label'    => 'Не выбран',
                        'selected' => 'selected',
                    ],
                    '1'  => 'Да',
                    '2'  => 'Нет',
                ],
            ],
        ]);
    }
}

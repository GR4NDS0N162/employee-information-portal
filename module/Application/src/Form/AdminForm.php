<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Select;

class AdminForm extends ListForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name'       => 'active',
            'type'       => Select::class,
            'attributes' => [
                'class' => 'form-select',
            ],
            'options'    => [
                'label'            => 'Активен',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => [
                    null => 'Не важно',
                    '1'  => [
                        'label'    => 'Да',
                        'selected' => 'selected',
                    ],
                    '2'  => 'Нет',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'admin',
            'type'       => Select::class,
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
                        'label'    => 'Не важно',
                        'selected' => 'selected',
                    ],
                    '1'  => 'Да',
                    '2'  => 'Нет',
                ],
            ],
        ]);
    }
}

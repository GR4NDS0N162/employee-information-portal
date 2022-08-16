<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class EditUserForm extends EditProfileForm
{
    public const DEFAULT_NAME = 'edit-user-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->add([
            'name'       => 'position',
            'type'       => Element\Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => [
                    '1' => 'Уборщик',
                    '2' => 'Фасовщик',
                    '3' => 'Менеджер',
                    '4' => 'Швейцар',
                    '5' => 'Шеф',
                    '6' => 'Экономист',
                    '7' => 'Электрик',
                    '8' => 'Юрист',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'status',
            'type'       => StatusFieldset::class,
            'attributes' => [
                'class' => 'row gy-1',
            ],
        ]);

        $this->setPriority('status', -90);
        $this->setPriority('skype', -80);
        $this->setPriority('position', -70);
    }
}

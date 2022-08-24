<?php

namespace Application\Form;

use Application\Form\Options\PositionOptions;
use Laminas\Form\Element;

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
                'options'          => PositionOptions::getOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'status',
            'type'       => StatusFieldset::class,
            'attributes' => [
                'class' => 'row gy-1',
            ],
        ]);

        FieldsetMapper::setMapping($this, [
            'photo'         => 'col-12',
            'surname'       => 'col-12 col-xl-4',
            'name'          => 'col-12 col-xl-4',
            'patronymic'    => 'col-12 col-xl-4',
            'gender'        => 'col-12 col-sm-6',
            'birthday'      => 'col-12 col-sm-6',
            'skype'         => 'col-12 col-lg-6',
            'position'      => 'col-12 col-lg-6',
            'submit-button' => 'col-12',
        ]);

        $this->setPriority('status', -90);
        $this->setPriority('skype', -80);
        $this->setPriority('position', -70);
    }
}

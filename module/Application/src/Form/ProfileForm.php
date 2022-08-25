<?php

namespace Application\Form;

use Application\Fieldset\ProfileFieldset;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class ProfileForm extends Form
{
    public function init()
    {
        $this->setAttribute('class', 'row g-3');

        $this->add([
            'name'       => 'profile',
            'type'       => ProfileFieldset::class,
            'attributes' => [
                'class' => 'row g-3',
            ],
            'options'    => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [
                'value' => 'Сохранить изменения',
                'class' => 'btn btn-outline-success w-100',
            ],
        ]);
    }
}
<?php

namespace Application\Form;

use Application\Fieldset\ProfileFieldset;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class ProfileForm extends Form
{
    public function init()
    {
        $this->add([
            'name'    => 'profile',
            'type'    => ProfileFieldset::class,
            'options' => [
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

        FieldsetMapper::setMapping($this, [
            'profile' => 'col-12',
            'submit'  => 'col-12',
        ]);
    }
}
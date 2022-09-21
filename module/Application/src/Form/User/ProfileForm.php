<?php

namespace Application\Form\User;

use Application\Fieldset\ProfileFieldset;
use Application\Helper\FieldsetMapper;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class ProfileForm extends Form
{
    public function init()
    {
        $this->setAttribute('class', 'row g-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'profile',
            'type'       => ProfileFieldset::class,
            'attributes' => [
                'class' => 'row g-3 align-items-start',
            ],
            'options'    => [
                'use_as_base_fieldset' => true,
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [
                'value' => 'Save your changes',
                'class' => 'btn btn-outline-success w-100',
            ],
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'profile' => [
                    'value'    => 'col-12',
                    'children' => [
                        'id'         => 'd-none',
                        'image'      => 'col-12',
                        'imageFile'  => 'col-12',
                        'surname'    => 'col-12 col-lg-4',
                        'name'       => 'col-12 col-sm-6 col-lg-4',
                        'patronymic' => 'col-12 col-sm-6 col-lg-4',
                        'gender'     => 'col-12 col-sm-6 col-lg-4',
                        'birthday'   => 'col-12 col-sm-6 col-lg-4',
                        'skype'      => 'col-12 col-lg-4',
                        'emails'     => [
                            'value'          => 'col-12 col-lg-6',
                            'target_element' => 'col-12',
                        ],
                        'phones'     => [
                            'value'          => 'col-12 col-lg-6',
                            'target_element' => 'col-12',
                        ],
                    ],
                ],
                'submit'  => 'col-12',
            ],
        ]);
    }
}
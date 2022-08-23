<?php

namespace User\Form;

use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Tel;

class PhoneCollection extends Collection
{
    public function init()
    {
        $this->setAttributes([
            'class' => 'row g-3 collection-list',
        ]);

        $this->setOptions([
            'count'                  => 0,
            'should_create_template' => true,
            'allow_add'              => true,
            'allow_remove'           => true,
            'target_element'         => [
                'type'       => Tel::class,
                'attributes' => [
                    'class'           => 'form-control validation-pattern-phone',
                    'delimiter_class' => 'col-12',
                    'placeholder'     => '+7xxxxxxxxxx',
                    'required'        => 'required',
                    'pattern'         => '^\+7[0-9]{10}$',
                ],
            ],
        ]);
    }
}

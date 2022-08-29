<?php

namespace Application\Form\Admin;

use Application\Form\User\UserFilterForm;
use Application\Helper\FieldsetMapper;
use Application\Model\Options\YesNoOptions;
use Laminas\Form\Element;

class AdminFilterForm extends UserFilterForm
{
    public function init()
    {
        parent::init();

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

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'active' => 'col-12',
                'admin'  => 'col-12',
            ],
        ]);
    }
}

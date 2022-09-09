<?php

namespace Application\Fieldset;

use Application\Model\Repository\StatusRepositoryInterface;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Fieldset;

class StatusFieldset extends Fieldset
{
    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;

    /**
     * @param StatusRepositoryInterface $statusRepository
     */
    public function __construct($statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function init()
    {
        parent::init();

        $this->add([
            'name'       => 'admin',
            'type'       => Checkbox::class,
            'attributes' => [
                'class' => 'form-check-input',
                'id'    => uniqid('checkbox_', true),
            ],
            'options'    => [
                'label'              => 'Администратор',
                'label_attributes'   => [
                    'class' => 'form-check-label',
                ],
                'use_hidden_element' => false,
            ],
        ]);

        $this->add([
            'name'       => 'active',
            'type'       => Checkbox::class,
            'attributes' => [
                'class' => 'form-check-input',
                'id'    => uniqid('checkbox_', true),
            ],
            'options'    => [
                'label'              => 'Активен',
                'label_attributes'   => [
                    'class' => 'form-check-label',
                ],
                'use_hidden_element' => false,
            ],
        ]);
    }
}

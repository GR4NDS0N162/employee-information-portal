<?php

namespace Application\Fieldset;

use Application\Helper\FieldsetMapper;
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
        parent::__construct();

        $this->statusRepository = $statusRepository;
    }

    public function init()
    {
        parent::init();

        $statuses = $this->statusRepository->findAllStatuses();

        foreach ($statuses as $status) {
            $this->add([
                'name'       => $status->getName(),
                'type'       => Checkbox::class,
                'attributes' => [
                    'class'             => 'form-check-input',
                    FieldsetMapper::KEY => 'col-12 col-sm-6',
                    'id'                => uniqid('checkbox_', true),
                ],
                'options'    => [
                    // TODO: Add a column for the name of the status displayed to the user.
                    'label'              => $status->getName(),
                    'label_attributes'   => [
                        'class' => 'form-check-label',
                    ],
                    'use_hidden_element' => false,
                ],
            ]);
        }
    }
}
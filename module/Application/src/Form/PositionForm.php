<?php

namespace Application\Form;

use Laminas\Form\Form;

class PositionForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes([
            'class' => 'row g-3',
        ]);

        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/AddButton.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PositionCollection.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/SubmitButton.php');

        $this->get('add-button')
            ->setOptions([
                'label' => 'Добавить новую должность',
            ]);

        $this->get('submit-button')
            ->setAttributes([
                'class' => 'btn btn-lg btn-outline-success w-100',
            ])
            ->setOptions([
                'label' => 'Сохранить изменения',
            ]);
    }
}

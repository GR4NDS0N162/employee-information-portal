<?php

namespace Application\Form;

use Laminas\Form\Form;

class PositionForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PositionCollection.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/SubmitButton.php');
    }
}

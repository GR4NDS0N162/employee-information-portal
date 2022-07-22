<?php

namespace Application\Fieldset;

use Laminas\Form\Fieldset;

class PositionButtonFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../Button/DeleteButton.phtml');
    }
}

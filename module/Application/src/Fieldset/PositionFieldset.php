<?php

namespace Application\Fieldset;

use Laminas\Form\Fieldset;

class PositionFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../Element/PositionElement.php');
        $this->add(include __DIR__ . '/../Element/PositionButtonFieldset.php');
    }
}

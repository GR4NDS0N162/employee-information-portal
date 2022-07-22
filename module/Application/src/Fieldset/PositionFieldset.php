<?php

namespace Application\Fieldset;

use Laminas\Form\Fieldset;

class PositionFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PositionElement.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PositionButtonFieldset.php');
    }
}

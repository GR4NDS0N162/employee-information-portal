<?php

namespace Application\Form;

use Laminas\Form\Form;

class SignUpForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/EmailElement.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PositionSelect.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PasswordElement.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PasswordCheckElement.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/SubmitElement.php');
    }
}

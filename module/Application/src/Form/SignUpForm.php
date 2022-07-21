<?php

namespace Application\Form;

use Laminas\Form\Form;

class SignUpForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../Element/EmailElement.php');
        $this->add(include __DIR__ . '/../Element/PositionSelect.php');
        $this->add(include __DIR__ . '/../Element/PasswordElement.php');
        $this->add(include __DIR__ . '/../Element/PasswordCheckElement.php');
        $this->add(include __DIR__ . '/../Element/SubmitElement.php');
    }
}

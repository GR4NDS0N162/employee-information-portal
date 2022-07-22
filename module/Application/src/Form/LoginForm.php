<?php

namespace Application\Form;

use Laminas\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/EmailInput.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/PasswordInput.php');
        $this->add(include __DIR__ . '/../ElementOrFieldsetArray/SubmitButton.php');

        $this->get('submit-button')
            ->setAttributes([
                'class' => 'btn btn-lg btn-outline-primary w-100',
            ])
            ->setOptions([
                'label' => 'Войти',
            ]);
    }
}

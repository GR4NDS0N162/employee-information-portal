<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options' => [
                'label' => 'Пароль',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class GeneratePasswordForm extends Form
{
    public const DEFAULT_NAME = 'generate-password-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row gy-3');

        $this->add([
            'name'       => 'submit-button',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-outline-primary w-100',
            ],
            'options'    => [
                'label' => 'Сгенерировать пароль и отправить на почту',
            ],
        ]);
    }
}

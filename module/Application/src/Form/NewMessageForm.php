<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class NewMessageForm extends Form
{
    public const DEFAULT_NAME = 'new-message-form';

    public function __construct($name = self::DEFAULT_NAME)
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row gx-3');

        $this->add([
            'name'       => 'message',
            'type'       => Element\Text::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Напишите сообщение...',
                'required'    => 'required',
            ],
        ]);

        $this->add([
            'name'       => 'submit-button',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Отправить',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        $classMap = [
            'message'       => 'col',
            'submit-button' => 'col-auto',
        ];

        foreach ($classMap as $name => $class)
            $this->get($name)->setAttribute('delimiter_class', $class);
    }
}

<?php

namespace Application\Form\Messenger;

use Application\Helper\FieldsetMapper;
use Laminas\Form\Element;
use Laminas\Form\Form;

class NewMessageForm extends Form
{
    public function init()
    {
        parent::init();

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

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'message'       => 'col',
                'submit-button' => 'col-auto',
            ]
        ]);
    }
}

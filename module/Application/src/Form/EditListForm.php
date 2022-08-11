<?php

namespace Application\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

abstract class EditListForm extends Form
{
    protected $addButton = [
        'name' => 'add-button',
        'type' => Element\Button::class,
        'attributes' => [
            'type' => 'button',
            'class' => 'btn btn-outline-primary w-100',
            'onclick' => 'add_item(this)',
        ],
        'options' => [
            'label' => 'Добавить',
        ],
    ];

    protected $list = [
        'name' => 'list',
        'type' => Element\Collection::class,
        'attributes' => [
            'class' => 'row g-3',
        ],
        'options' => [
            'count' => 0,
            'should_create_template' => true,
            'allow_add' => true,
            'allow_remove' => true,
        ],
    ];

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', '');

        $this->add($this->addButton);
        $this->add($this->list);

        $this->add([
            'name' => 'submit-button',
            'type' => Element\Button::class,
            'attributes' => [
                'type' => 'submit',
                'class' => 'btn btn-outline-success w-100',
            ],
            'options' => [
                'label' => 'Сохранить изменения',
            ],
        ]);
    }
}

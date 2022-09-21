<?php

namespace Application\Form\Login;

use Application\Fieldset\ProfileFieldset;
use Application\Helper\FieldsetMapper;
use Application\Model\Options\PositionOptions;
use Laminas\Form\Element;
use Laminas\Form\Form;

class SignUpForm extends Form
{
    /**
     * @var PositionOptions
     */
    private $positionOptions;

    public function __construct(
        PositionOptions $positionOptions
    ) {
        parent::__construct();

        $this->positionOptions = $positionOptions;
    }

    public function init()
    {
        parent::init();

        $this->setAttribute('class', 'row gy-3 needs-validation');
        $this->setAttribute('novalidate', true);

        $this->add([
            'name'       => 'email',
            'type'       => Element\Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
            'options'    => [
                'label'            => 'E-mail',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'positionId',
            'type'       => Element\Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Position',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
                'options'          => $this->positionOptions->getDisabledOptions(),
            ],
        ]);

        $this->add([
            'name'       => 'newPassword',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'        => 'form-control',
                'placeholder'  => 'qwerty123',
                'required'     => 'required',
                'autocomplete' => 'new-password',
                'minlength'    => 8,
                'maxlength'    => 32,
                'pattern'      => '^(?=.*?[а-яa-z])(?=.*?[А-ЯA-Z])(?=.*?[0-9])(?=.*?[!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~])[а-яa-zА-ЯA-Z0-9!"#\$%&\'\(\)\*\+,-\.\/:;<=>\?@[\]\^_`\{\|}~]*$',
            ],
            'options'    => [
                'label'            => 'Password',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'passwordCheck',
            'type'       => Element\Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
                'pattern'     => '',
            ],
            'options'    => [
                'label'            => 'Password confirm',
                'label_attributes' => ProfileFieldset::DEFAULT_LABEL_ATTRIBUTES,
            ],
        ]);

        $this->add([
            'name'       => 'submitButton',
            'type'       => Element\Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-lg btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Sign up',
            ],
        ], [
            'priority' => -10 ** 9,
        ]);

        FieldsetMapper::setAttributes($this, [
            'children' => [
                'email'         => 'col-12',
                'positionId'    => 'col-12',
                'newPassword'   => 'col-12',
                'passwordCheck' => 'col-12',
                'submitButton'  => 'col-12',
            ],
        ]);
    }
}
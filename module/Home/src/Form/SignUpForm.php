<?php

namespace Home\Form;

use Home\Model\PositionRepositoryInterface;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Select;
use Laminas\Form\Form;

class SignUpForm extends Form
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    /**
     * @param PositionRepositoryInterface $positionRepository
     */
    public function __construct($positionRepository)
    {
        parent::__construct();
        $this->positionRepository = $positionRepository;
    }

    public function init()
    {
        $this->add([
            'name'       => 'email',
            'type'       => Email::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'name@example.com',
                'required'    => 'required',
                'pattern'     => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
            ],
            'options'    => [
                'label'            => 'E-mail',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $positionOptions = [
            0 => [
                'label'    => 'Не выбрана',
                'disabled' => 'disabled',
                'selected' => 'selected',
            ],
        ];
        foreach ($this->positionRepository->findAllPositions() as $position)
            $positionOptions[$position->getId()] = $position->getName();

        $this->add([
            'name'       => 'position',
            'type'       => Select::class,
            'attributes' => [
                'class'    => 'form-select',
                'required' => 'required',
            ],
            'options'    => [
                'label'            => 'Должность',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
                'options'          => $positionOptions,
            ],
        ]);

        $this->add([
            'name'       => 'new-password',
            'type'       => Password::class,
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
                'label'            => 'Пароль',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'password-check',
            'type'       => Password::class,
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'qwerty123',
                'required'    => 'required',
                'pattern'     => '',
            ],
            'options'    => [
                'label'            => 'Подтверждение пароля',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
        ]);

        $this->add([
            'name'       => 'submit-button',
            'type'       => Button::class,
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-lg btn-outline-success w-100',
            ],
            'options'    => [
                'label' => 'Зарегистрироваться',
            ],
        ]);
    }
}

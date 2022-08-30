<?php

namespace Application\Helper;

use Laminas\Form\FormInterface;

class ViewForm extends UserForm
{
    public function render(FormInterface $form): string
    {
        return preg_replace(
            [
                '/<button.*button>/',
                '/<input.*type="(submit|button)".*>/',
            ],
            '',
            parent::render($form)
        );
    }
}
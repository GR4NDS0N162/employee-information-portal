<?php

namespace Application\Helper;

use Laminas\Form\FieldsetInterface;
use Laminas\Form\FormInterface;
use Laminas\Form\View\Helper\Form;
use Laminas\View\Renderer\PhpRenderer;

class UserFormHelper extends Form
{
    public function render(FormInterface $form): string
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        $renderer = $this->getView();
        assert($renderer instanceof PhpRenderer);

        foreach ($form as $elementOrFieldset) {
            switch (true) {
                case $elementOrFieldset instanceof FieldsetInterface:
                    $formContent .= $renderer->formCollection($elementOrFieldset);
                    break;
                default:
                    $formContent .= $renderer->formRow($elementOrFieldset);
                    break;
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }
}
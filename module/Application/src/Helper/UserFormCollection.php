<?php

namespace Application\Helper;

use Laminas\Form\Element\Collection;
use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\FormCollection;

class UserFormCollection extends FormCollection
{
    public function __construct()
    {
        $this->setDefaultElementHelper('userFormRow');

        $this->setWrapper('%2$s<div%4$s>%3$s%1$s</div>');
        $this->setLabelWrapper('<div class="form-label order-first">%s</div>');
        $this->setTemplateWrapper(
            '<span class="d-none" data-template="%s"></span>' .
            '<div class="notification">Список пуст.</div>'
        );
    }

    public function render(ElementInterface $element): string
    {
        $format = '%1$s';
        $values = [parent::render($element)];

        if ($element instanceof Collection) {
            $values[] = $element->getAttribute(FieldsetMapper::KEY);
            $format = sprintf(
                '<div class="card d-flex p-3">%1$s%2$s</div>',
                $format,
                '<button type="button" name="add" class="btn btn-outline-primary order-first mb-3" value="">Добавить в список</button>'
            );
        }

        if ($element->hasAttribute(FieldsetMapper::KEY)) {
            $values[] = $element->getAttribute(FieldsetMapper::KEY);
            $format = sprintf(
                '<div class="%2$s">%1$s</div>',
                $format,
                '%' . count($values) . '$s'
            );
        }

        return sprintf($format, ...$values);
    }
}
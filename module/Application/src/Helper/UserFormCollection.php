<?php

namespace Application\Helper;

use Laminas\Form\ElementInterface;
use Laminas\Form\View\Helper\FormCollection;
use Laminas\View\Helper\Doctype;

class UserFormCollection extends FormCollection
{
    /** @var array */
    private $doctypesAllowedToHaveNameAttribute = [
        Doctype::HTML5  => true,
        Doctype::XHTML5 => true,
    ];

    public function __construct()
    {
        $this->setDefaultElementHelper('userFormRow');

        $this->setWrapper('%2$s<div%4$s>%3$s%1$s</div>');
        $this->setLabelWrapper('<div class="form-label">%s</div>');
        $this->setTemplateWrapper('<span class="d-none" data-template="%s"></span>');
    }

    public function render(ElementInterface $element): string
    {
        return sprintf('<div class="%2$s">%1$s</div>',
            parent::render($element),
            $element->getAttribute(FieldsetMapper::KEY),
        );
    }
}
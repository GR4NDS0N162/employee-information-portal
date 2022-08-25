<?php

namespace Application\Helper;

use Laminas\Form\Element\Collection;
use Laminas\Form\ElementInterface;
use Laminas\Form\FieldsetInterface;
use Laminas\Form\LabelAwareInterface;
use Laminas\Form\View\Helper\FormCollection;
use Laminas\View\Helper\Doctype;

class UserFormCollection extends FormCollection
{
    /** @var array */
    private $doctypesAllowedToHaveNameAttribute = [
        Doctype::HTML5  => true,
        Doctype::XHTML5 => true,
    ];

    public function render(ElementInterface $element): string
    {
        $renderer = $this->getView();
        if ($renderer !== null && !method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }

        $markup = '';
        $templateMarkup = '';
        $elementHelper = $this->getElementHelper();
        assert(is_callable($elementHelper));
        $fieldsetHelper = $this->getFieldsetHelper();
        assert(is_callable($fieldsetHelper));

        if ($element instanceof Collection && $element->shouldCreateTemplate()) {
            $templateMarkup = $this->renderTemplate($element);
        }

        foreach ($element->getIterator() as $elementOrFieldset) {
            switch (true) {
                case $elementOrFieldset instanceof FieldsetInterface:
                    $markup .= $fieldsetHelper($elementOrFieldset, $this->shouldWrap());
                    break;
                case $elementOrFieldset instanceof ElementInterface:
                    $markup .= $elementHelper($elementOrFieldset);
                    break;
            }
        }

        // Every collection is wrapped by a fieldset if needed
        if ($this->shouldWrap) {
            $attributes = $element->getAttributes();
            if (!isset($this->doctypesAllowedToHaveNameAttribute[$this->getDoctype()])) {
                unset($attributes['name']);
            }
            $attributesString = $attributes !== [] ? ' ' . $this->createAttributesString($attributes) : '';

            $label = $element->getLabel();
            $legend = '';

            if (!empty($label)) {
                if (null !== ($translator = $this->getTranslator())) {
                    $label = $translator->translate(
                        $label,
                        $this->getTranslatorTextDomain()
                    );
                }

                if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
                    $escapeHtmlHelper = $this->getEscapeHtmlHelper();
                    $label = $escapeHtmlHelper($label);
                }

                $legend = sprintf(
                    $this->labelWrapper,
                    $label
                );
            }

            $markup = sprintf(
                $this->wrapper,
                $markup,
                $legend,
                $templateMarkup,
                $attributesString
            );
        } else {
            $markup .= $templateMarkup;
        }

        return $markup;
    }
}
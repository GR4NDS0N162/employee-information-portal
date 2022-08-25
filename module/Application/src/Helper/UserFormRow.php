<?php

namespace Application\Helper;

use Laminas\Form\View\Helper\FormRow;

class UserFormRow extends FormRow
{
    public function __construct()
    {
        $this->setPartial('partial/user-partial.phtml');
    }
}
<?php

declare(strict_types=1);

namespace Application\Form;

use Laminas\Form\Form;

class ProfileForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->attributes = [
        ];
    }
}

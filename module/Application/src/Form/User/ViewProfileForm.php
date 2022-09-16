<?php

namespace Application\Form\User;

use Application\Helper\FieldsetMapper;
use Laminas\Form\Element;

class ViewProfileForm extends ProfileForm
{
    public function init()
    {
        parent::init();

        $this->get('profile')->remove('imageFile');
        $this->get('profile')->add([
            'name'       => 'image',
            'type'       => Element\Image::class,
            'attributes' => [
                'class' => 'user-photo-bg w-100 rounded',
                'alt'   => 'Фото пользователя'
            ],
        ], ['priority' => 100]);

        FieldsetMapper::setDisabled($this);

        FieldsetMapper::setAttributes(
            $this->get('profile')->get('image'),
            'col-12 d-flex justify-content-center'
        );
    }
}
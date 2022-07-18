<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\ProfileForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProfileController extends AbstractActionController
{
    public function viewAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function editAction()
    {
        $profileForm = new ProfileForm();

        $view = new ViewModel([
            'profileForm' => $profileForm,
        ]);

        return $view;
    }

    public function processAction()
    {
        return new ViewModel();
    }
}

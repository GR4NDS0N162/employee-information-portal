<?php

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Model\ProfileRepositoryInterface;

class ProfileController extends AbstractActionController
{
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct($profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function indexAction()
    {
        $userId = 1;

        return new ViewModel([
            'profile' => $this->profileRepository->findProfile($userId),
        ]);
    }
}

<?php

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Model\ListRepositoryInterface;
use User\Model\ProfileRepositoryInterface;

class ProfileController extends AbstractActionController
{
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * @var ListRepositoryInterface
     */
    private $listRepository;

    /**
     * @param ProfileRepositoryInterface $profileRepository
     * @param ListRepositoryInterface $listRepository
     */
    public function __construct($profileRepository, $listRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->listRepository = $listRepository;
    }

    public function indexAction()
    {
        $userId = 1;

        return new ViewModel([
            'profile' => $this->profileRepository->findProfile($userId),
            'phones'  => $this->listRepository->findItemsOfUser($userId, 'phone'),
            'emails'  => $this->listRepository->findItemsOfUser($userId, 'email'),
        ]);
    }
}

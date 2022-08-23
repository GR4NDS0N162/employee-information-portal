<?php

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Form\ProfileInfoForm;
use User\Model\EmailRepositoryInterface;
use User\Model\PhoneRepositoryInterface;
use User\Model\ProfileCommandInterface;
use User\Model\ProfileRepositoryInterface;

class ProfileController extends AbstractActionController
{
    /**
     * @var PhoneRepositoryInterface
     */
    private $phoneRepository;

    /**
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * @var ProfileInfoForm
     */
    private $profileInfoForm;

    /**
     * @var ProfileCommandInterface
     */
    private $profileCommand;

    /**
     * @param PhoneRepositoryInterface $phoneRepository
     * @param EmailRepositoryInterface $emailRepository
     * @param ProfileRepositoryInterface $profileRepository
     * @param ProfileInfoForm $profileInfoForm
     * @param ProfileCommandInterface $profileCommand
     */
    public function __construct(
        $phoneRepository,
        $emailRepository,
        $profileRepository,
        $profileInfoForm,
        $profileCommand
    )
    {
        $this->phoneRepository = $phoneRepository;
        $this->emailRepository = $emailRepository;
        $this->profileRepository = $profileRepository;
        $this->profileInfoForm = $profileInfoForm;
        $this->profileCommand = $profileCommand;
    }

    /**
     * Идентификатор вашего пользователя.
     *
     * TODO: Надо организовать систему аутентификации.
     */
    private const userId = 1;

    public function indexAction()
    {
        return new ViewModel([
            'phones'  => $this->phoneRepository->findPhonesOfUser(self::userId),
            'emails'  => $this->emailRepository->findEmailsOfUser(self::userId),
            'profile' => $this->profileRepository->findProfile(self::userId),
        ]);
    }

    public function editAction()
    {
        // TODO: Implement editAction() method.
    }
}

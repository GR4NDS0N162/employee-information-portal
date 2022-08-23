<?php

namespace Home\Controller;

use Home\Form\LoginForm;
use Home\Form\RecoverForm;
use Home\Form\SignUpForm;
use Home\Model\EmailRepositoryInterface;
use Home\Model\PositionRepositoryInterface;
use Home\Model\UserCommandInterface;
use Home\Model\UserRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class HomeController extends AbstractActionController
{
    /**
     * @var PositionRepositoryInterface
     */
    private $positionRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @var UserCommandInterface
     */
    private $userCommand;

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @var SignUpForm
     */
    private $signUpForm;

    /**
     * @var RecoverForm
     */
    private $recoverForm;

    /**
     * @param PositionRepositoryInterface $positionRepository
     * @param UserRepositoryInterface $userRepository
     * @param EmailRepositoryInterface $emailRepository
     * @param UserCommandInterface $userCommand
     * @param LoginForm $loginForm
     * @param SignUpForm $signUpForm
     * @param RecoverForm $recoverForm
     */
    public function __construct(
        $positionRepository,
        $userRepository,
        $emailRepository,
        $userCommand,
        $loginForm,
        $signUpForm,
        $recoverForm
    )
    {
        $this->positionRepository = $positionRepository;
        $this->userRepository = $userRepository;
        $this->emailRepository = $emailRepository;
        $this->userCommand = $userCommand;
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'loginForm'   => $this->loginForm,
            'signUpForm'  => $this->signUpForm,
            'recoverForm' => $this->recoverForm,
        ]);
    }

    public function loginAction()
    {
    }

    public function signUpAction()
    {
    }

    public function recoverAction()
    {
    }
}

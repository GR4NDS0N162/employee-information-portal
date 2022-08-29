<?php

namespace Application\Controller;

use Application\Form;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\UserCommandInterface;
use Exception;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    /**
     * @var Form\Login\LoginForm
     */
    private $loginForm;

    /**
     * @var Form\Login\SignUpForm
     */
    private $signUpForm;

    /**
     * @var Form\Login\RecoverForm
     */
    private $recoverForm;

    /**
     * @var UserCommandInterface
     */
    private $userCommand;

    public function __construct(
        Form\Login\LoginForm   $loginForm,
        Form\Login\SignUpForm  $signUpForm,
        Form\Login\RecoverForm $recoverForm,
        UserCommandInterface   $userCommand
    ) {
        $this->loginForm = $loginForm;
        $this->signUpForm = $signUpForm;
        $this->recoverForm = $recoverForm;
        $this->userCommand = $userCommand;
    }

    public function indexAction(): ViewModel
    {
        $viewModel = new ViewModel();

        $this->layout('layout/home-layout');

        $headTitleName = 'Вход | Регистрация';

        $this->layout()->setVariable('headTitleName', $headTitleName);

        $viewModel->setVariables([
            'loginForm'   => $this->loginForm,
            'signUpForm'  => $this->signUpForm,
            'recoverForm' => $this->recoverForm,
        ]);

        return $viewModel;
    }

    public function loginAction()
    {
    }

    public function signUpAction(): Response
    {
        $request = $this->getRequest();

        if (!$request->isPost())
            return $this->redirect()->toRoute('home');

        $this->signUpForm->setData($request->getPost());

        if (!$this->signUpForm->isValid())
            return $this->redirect()->toRoute('home');

        $data = $this->signUpForm->getData();

        $email = new Email($data['email']);
        $user = new User();
        $user->setPositionId($data['position']);
        $user->setPassword($data['new-password']);

        try {
            $this->userCommand->insertUser($user, $email);
        } catch (Exception $ex) {
            throw $ex;
        }

        return $this->redirect()->toRoute('user\view-profile');
    }

    public function recoverAction(): Response
    {
        $request = $this->getRequest();

        if (!$request->isPost())
            return $this->redirect()->toRoute('home');

        $this->recoverForm->setData($request->getPost());

        if (!$this->recoverForm->isValid())
            return $this->redirect()->toRoute('home');

        $data = $this->recoverForm->getData();
        $email = new Email($data['email']);

        try {
            $this->userCommand->setTempPassword($email);
        } catch (Exception $ex) {
            throw $ex;
        }

        return $this->redirect()->toRoute('home');
    }
}

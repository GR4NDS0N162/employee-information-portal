<?php

namespace Application\Model\Command;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\UserCommandInterface;
use Application\Model\UserRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;

class UserCommand implements UserCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        AdapterInterface         $db,
        EmailRepositoryInterface $emailRepository,
        UserRepositoryInterface  $userRepository
    ) {
        $this->db = $db;
        $this->emailRepository = $emailRepository;
        $this->userRepository = $userRepository;
    }

    public function insertUser(User $user, Email $email)
    {
        // TODO: Implement insertUser() method.
    }

    public function setTempPassword(Email $email)
    {
        // TODO: Implement setTempPassword() method.
    }
}
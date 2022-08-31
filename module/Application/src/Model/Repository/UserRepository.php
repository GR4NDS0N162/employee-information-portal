<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Sql\Select;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
{
    private $db;
    private $hydrator;
    private $prototype;
    private $emailRepository;
    private $phoneRepository;
    private $statusRepository;

    public function __construct($db, $hydrator, $prototype, $emailRepository, $phoneRepository, $statusRepository)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->statusRepository = $statusRepository;
    }

    public function findUser($identifier)
    {
        $select = new Select('user');
        $select->columns([
            'id',
            'password',
            'tempPassword' => 'temp_password',
            'tpCreatedAt'  => 'tp_created_at',
            'positionId'   => 'position_id',
            'surname',
            'name',
            'patronymic',
            'gender',
            'birthday',
            'image',
            'skype',
        ]);

        if (is_integer($identifier)) {
            $select->where(['id = ?' => $identifier]);

            $runtimeExceptionMessage = sprintf(
                'Failed retrieving user with id "%d"; unknown database error',
                $identifier
            );
            $invalidArgumentExceptionMessage = sprintf(
                'User with id "%d" not found',
                $identifier
            );
        } else if ($identifier instanceof Email) {
            $select->where(['id = ?' => $identifier->getUserId()]);

            $runtimeExceptionMessage = sprintf(
                'Failed retrieving user with email address "%s"; unknown database error',
                $identifier->getAddress()
            );
            $invalidArgumentExceptionMessage = sprintf(
                'User with email address "%s" not found',
                $identifier->getAddress()
            );
        } else {
            throw new InvalidArgumentException(
                'An inappropriate type parameter was passed.'
            );
        }

        $user = Extracter::extractValue($select, $this->db, $this->hydrator, $this->prototype);

        if (!$user instanceof User) {
            if (is_integer($identifier)) {
                throw new RuntimeException(
                    sprintf(
                        'Failed retrieving user with id "%d"; unknown repository error',
                        $identifier
                    )
                );
            } else {
                throw new RuntimeException(
                    sprintf(
                        'Failed retrieving user with email address "%s"; unknown repository error',
                        $identifier->getAddress()
                    )
                );
            }
        }

        $emails = $this->emailRepository->findEmailsOfUser($user->getId());
        $phones = $this->phoneRepository->findPhonesOfUser($user->getId());
        $statusMap = $this->statusRepository->generateStatusMapOfUser($user->getId());

        $user->setEmails($emails);
        $user->setPhones($phones);
        $user->setStatus($statusMap);

        return $user;
    }

    public function findUserById($id)
    {
        // TODO: Implement findUserById() method.
    }

    public function findUserByEmail($email)
    {
        // TODO: Implement findUserByEmail() method.
    }
}
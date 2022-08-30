<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\Executer;
use Application\Model\PhoneRepositoryInterface;
use Application\Model\StatusRepositoryInterface;
use Application\Model\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\HydratorInterface;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var User
     */
    private $userPrototype;

    /**
     * @var EmailRepositoryInterface
     */
    private $emailRepository;

    /**
     * @var PhoneRepositoryInterface
     */
    private $phoneRepository;

    /**
     * @var StatusRepositoryInterface
     */
    private $statusRepository;

    public function __construct(
        AdapterInterface          $db,
        HydratorInterface         $hydrator,
        User                      $userPrototype,
        EmailRepositoryInterface  $emailRepository,
        PhoneRepositoryInterface  $phoneRepository,
        StatusRepositoryInterface $statusRepository
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->userPrototype = $userPrototype;
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->statusRepository = $statusRepository;
    }

    public function findUser($identifier): User
    {
        $sql = new Sql($this->db);
        $select = $sql->select('user');
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

        $user = Executer::extractValue(
            $sql,
            $select,
            $this->hydrator,
            $this->userPrototype,
            $runtimeExceptionMessage,
            $invalidArgumentExceptionMessage,
        );

        if (!$user instanceof User) {
            if (is_integer($identifier)) {
                $runtimeExceptionMessage = sprintf(
                    'Failed retrieving user with id "%d"; unknown repository error',
                    $identifier
                );
            } else {
                $runtimeExceptionMessage = sprintf(
                    'Failed retrieving user with email address "%s"; unknown repository error',
                    $identifier->getAddress()
                );
            }
            throw new RuntimeException($runtimeExceptionMessage);
        }

        $emails = $this->emailRepository->findEmailsOfUser($user->getId());
        $phones = $this->phoneRepository->findPhonesOfUser($user->getId());

        $user->setEmails($emails);
        $user->setPhones($phones);

        return $user;
    }
}
<?php

namespace Application\Model\Repository;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\Entity\UserStatus;
use Application\Model\PhoneRepositoryInterface;
use Application\Model\StatusRepositoryInterface;
use Application\Model\UserRepositoryInterface;
use Application\Model\UserStatusRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
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
    private $prototype;
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
    /**
     * @var UserStatusRepositoryInterface
     */
    private $userStatusRepository;

    /**
     * @param AdapterInterface              $db
     * @param HydratorInterface             $hydrator
     * @param User                          $prototype
     * @param EmailRepositoryInterface      $emailRepository
     * @param PhoneRepositoryInterface      $phoneRepository
     * @param StatusRepositoryInterface     $statusRepository
     * @param UserStatusRepositoryInterface $userStatusRepository
     */
    public function __construct(
        $db,
        $hydrator,
        $prototype,
        $emailRepository,
        $phoneRepository,
        $statusRepository,
        $userStatusRepository
    ) {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->prototype = $prototype;
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->statusRepository = $statusRepository;
        $this->userStatusRepository = $userStatusRepository;
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
        $select->where(['id = ?' => $id]);

        $user = Extracter::extractValue($select, $this->db, $this->hydrator, $this->prototype);
        if (!$user instanceof User) {
            throw new RuntimeException(
                'Failed retrieving the object; unknown repository error.'
            );
        }

        $userStatuses = $this->userStatusRepository->findStatusesOfUser($user->getId());
        $statusMap = [];
        foreach ($this->statusRepository->findAllStatuses() as $status) {
            $statusMap[$status->getName()] = in_array(
                new UserStatus($status->getId(), $user->getId()),
                $userStatuses
            );
        }

        $emails = $this->emailRepository->findEmailsOfUser($user->getId());
        $phones = $this->phoneRepository->findPhonesOfUser($user->getId());

        $user->setStatus($statusMap);
        $user->setEmails($emails);
        $user->setPhones($phones);

        return $user;
    }

    public function findUserByEmail($email)
    {
        // TODO: Implement findUserByEmail() method.
    }
}
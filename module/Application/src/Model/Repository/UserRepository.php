<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\Entity\UserStatus;
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

    public function findProfile($identifier)
    {
        return $this->findUser($identifier);
    }

    public function findUser($identifier)
    {
        if (is_int($identifier)) {
            return $this->findUserById($identifier);
        } else if ($identifier instanceof Email) {
            return $this->findUserByEmail($identifier);
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'The type of the $identifier parameter must be compatible with %1$s; %2$s used',
                    implode(' or ', [gettype(1), Email::class]),
                    (get_class($identifier) ?: gettype($identifier))
                )
            );
        }
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
        $foundEmail = $this->emailRepository->findEmail($email->getAddress());

        return $this->findUserById($foundEmail->getUserId());
    }
}
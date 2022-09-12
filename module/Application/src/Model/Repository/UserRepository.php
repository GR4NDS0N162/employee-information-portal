<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Application\Model\Entity\User;
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

    private function findUserById($id)
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

        $this->pullExtraInfo($user);

        return $user;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    private function pullExtraInfo($user)
    {
        $userStatuses = $this->statusRepository->findStatusesOfUser($user->getId());
        $statusMap = [];
        foreach ($userStatuses as $status) {
            $statusMap[$status->getName()] = true;
        }
        $user->setStatus($statusMap);

        $emails = $this->emailRepository->findEmailsOfUser($user->getId());
        $user->setEmails($emails);

        $phones = $this->phoneRepository->findPhonesOfUser($user->getId());
        $user->setPhones($phones);

        return $user;
    }

    private function findUserByEmail($email)
    {
        $foundEmail = $this->emailRepository->findEmail($email->getAddress());

        return $this->findUserById($foundEmail->getUserId());
    }

    public function findUsers(
        $where = [],
        $order = [],
        $limit = null,
        $offset = null
    ) {
        $select = new Select(['u' => 'user']);
        $select->quantifier(Select::QUANTIFIER_DISTINCT);
        $select->columns([
            'id'           => 'u.id',
            'password'     => 'u.password',
            'tempPassword' => 'u.temp_password',
            'tpCreatedAt'  => 'u.tp_created_at',
            'positionId'   => 'u.position_id',
            'surname'      => 'u.surname',
            'name'         => 'u.name',
            'patronymic'   => 'u.patronymic',
            'gender'       => 'u.gender',
            'birthday'     => 'u.birthday',
            'image'        => 'u.image',
            'skype'        => 'u.skype',
        ], false);
        $select->join(
            ['us' => 'user_status'],
            'u.id = us.user_id',
            [],
            Select::JOIN_LEFT
        );
        $select->where($where);
        $select->order($order);
        if (isset($limit)) {
            $select->limit($limit);
        }
        if (isset($offset)) {
            $select->offset($offset);
        }

        $users = Extracter::extractValues($select, $this->db, $this->hydrator, $this->prototype);

        foreach ($users as $user) {
            $this->pullExtraInfo($user);
        }

        return $users;
    }
}
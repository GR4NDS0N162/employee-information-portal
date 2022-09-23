<?php

namespace Application\Model\Repository;

use Application\Controller\UserController;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;
    /**
     * @var User
     */
    private User $prototype;
    /**
     * @var EmailRepositoryInterface
     */
    private EmailRepositoryInterface $emailRepository;
    /**
     * @var PhoneRepositoryInterface
     */
    private PhoneRepositoryInterface $phoneRepository;
    /**
     * @var StatusRepositoryInterface
     */
    private StatusRepositoryInterface $statusRepository;

    /**
     * @param AdapterInterface          $db
     * @param EmailRepositoryInterface  $emailRepository
     * @param PhoneRepositoryInterface  $phoneRepository
     * @param StatusRepositoryInterface $statusRepository
     */
    public function __construct(
        AdapterInterface          $db,
        EmailRepositoryInterface  $emailRepository,
        PhoneRepositoryInterface  $phoneRepository,
        StatusRepositoryInterface $statusRepository
    ) {
        $this->db = $db;
        $this->prototype = new User();
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->statusRepository = $statusRepository;
    }

    public function findProfile($identifier)
    {
        return $this->findUser($identifier);
    }

    public function findUser($identifier)
    {
        if (is_int($identifier)) {
            return $this->findUserById($identifier);
        } elseif ($identifier instanceof Email) {
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
        $select = new Select(['u' => 'user']);
        $select->columns([
            'id'           => 'u.id',
            'password'     => 'u.password',
            'tempPassword' => 'u.temp_password',
            'tpCreatedAt'  => 'u.tp_created_at',
            'positionId'   => 'u.position_id',
            'positionName' => 'pos.name',
            'surname'      => 'u.surname',
            'name'         => 'u.name',
            'patronymic'   => 'u.patronymic',
            'gender'       => 'u.gender',
            'birthday'     => 'u.birthday',
            'image'        => 'u.image',
            'skype'        => 'u.skype',
        ], false);
        $select->where(['u.id = ?' => $id]);
        $select->join(
            ['pos' => 'position'],
            'pos.id = u.position_id',
            [],
        );

        /** @var User $user */
        $user = Extracter::extractValue(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );

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
        array  $whereConfig = [],
        string $orderConfig = 'fullname',
        bool   $limit = false,
        int    $page = 1
    ): array {
        $select = new Select(['u' => 'user']);
        $select->quantifier(Select::QUANTIFIER_DISTINCT);
        $select->columns([
            'id'           => 'u.id',
            'password'     => 'u.password',
            'tempPassword' => 'u.temp_password',
            'tpCreatedAt'  => 'u.tp_created_at',
            'positionId'   => 'u.position_id',
            'positionName' => 'pos.name',
            'surname'      => 'u.surname',
            'name'         => 'u.name',
            'patronymic'   => 'u.patronymic',
            'gender'       => 'u.gender',
            'birthday'     => 'u.birthday',
            'image'        => 'u.image',
            'skype'        => 'u.skype',
        ], false);
        $select->join(
            ['pos' => 'position'],
            'pos.id = u.position_id',
            [],
        );

        $select->where(UserRepository::parseWhereConfig($whereConfig));

        $select->order(UserRepository::parseOrderConfig($orderConfig));

        if ($limit) {
            $select->limit(UserController::MAX_USER_COUNT);
        }
        $select->offset(($page - 1) * UserController::MAX_USER_COUNT);

        /** @var User[] $users */
        $users = Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );

        foreach ($users as $user) {
            $this->pullExtraInfo($user);
        }

        return $users;
    }

    public static function parseWhereConfig(array $whereConfig): Where
    {
        $where = new Where();

        return $where;
    }

    public static function parseOrderConfig(string $orderConfig): array
    {
        $order = [
            'u.surname',
            'u.name',
            'u.patronymic',
            'pos.name',
            'u.gender',
            'u.birthday DESC',
        ];

        switch ($orderConfig) {
            case 'fullname':
                return $order;

            case 'position':
                array_unshift($order, 'pos.name');
                break;
            case 'age':
                array_unshift($order, 'u.birthday DESC');
                break;
            case 'gender':
                array_unshift($order, 'u.gender');
                break;

            default:
                return [];
        }

        return array_unique($order);
    }
}
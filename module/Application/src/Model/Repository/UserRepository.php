<?php

namespace Application\Model\Repository;

use Application\Helper\ConfigHelper;
use Application\Model\Entity\Email;
use Application\Model\Entity\Profile;
use Application\Model\Entity\User;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;

class UserRepository implements UserRepositoryInterface
{
    private AdapterInterface $db;
    private User $prototype;
    private EmailRepositoryInterface $emailRepository;
    private PhoneRepositoryInterface $phoneRepository;
    private StatusRepositoryInterface $statusRepository;

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

    public function findProfile($identifier): Profile
    {
        return $this->findUser($identifier);
    }

    public function findUser($identifier): User
    {
        if (is_integer($identifier)) {
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

    private function findUserById(int $userId): User
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
        $select->where(['u.id' => $userId]);
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

    private function pullExtraInfo(User $user)
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
    }

    private function findUserByEmail(Email $email): User
    {
        $foundEmail = $this->emailRepository->findEmail($email->getAddress());

        return $this->findUserById($foundEmail->getUserId());
    }

    public function findUsers(
        array  $whereConfig = [],
        string $orderConfig = 'fullname'
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

        $select->where(ConfigHelper::parseWhereConfig($whereConfig));

        $select->order(ConfigHelper::parseOrderConfig($orderConfig));

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
}
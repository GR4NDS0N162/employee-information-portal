<?php

namespace Application\Model\Repository;

use Application\Controller\UserController;
use Application\Helper\ConfigHelper;
use Application\Model\Entity\Email;
use Application\Model\Entity\Profile;
use Application\Model\Entity\User;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Predicate\Like;
use Laminas\Db\Sql\Predicate\PredicateSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

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

    public static function parseWhereConfig(
        array  $whereConfig,
        ?Where $where = null
    ): Where {
        if (!isset($where)) {
            $where = new Where();
        }

        if (isset($whereConfig['positionId'])) {
            $positionId = (integer)$whereConfig['positionId'];
            $where->equalTo('u.position_id', $positionId);
        }

        if (isset($whereConfig['gender'])) {
            $gender = (integer)$whereConfig['gender'];
            $where->equalTo('u.gender', $gender);
        }

        if (isset($whereConfig['age'])) {
            $ageConfig = $whereConfig['age'];

            if (isset($ageConfig['min'])) {
                $minAge = (integer)$ageConfig['min'];

                $where->greaterThanOrEqualTo(
                    new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW())'),
                    $minAge,
                );
            }

            if (isset($ageConfig['max'])) {
                $maxAge = (integer)$ageConfig['max'];

                $where->lessThanOrEqualTo(
                    new Expression('TIMESTAMPDIFF(YEAR, u.birthday, NOW())'),
                    $maxAge,
                );
            }
        }

        if (
            isset($whereConfig['fullnamePhone'])
            || isset($whereConfig['fullnamePhoneEmail'])
        ) {
            list($fullnameConfig, $phoneConfig, $emailConfig) = array_map(
                'trim',
                explode(',', $whereConfig['fullnamePhoneEmail'] ?: $whereConfig['fullnamePhone'])
            );

            $fullnameConfig = ConfigHelper::filterEmpty(explode(' ', $fullnameConfig));
            if (!empty($fullnameConfig)) {
                $fullnameWhere = new Where(null, PredicateSet::COMBINED_BY_OR);

                foreach ($fullnameConfig as $str) {
                    $str = strtolower($str);
                    $fullnameWhere->like(new Expression('LOWER(u.surname)'), '%' . $str . '%');
                    $fullnameWhere->like(new Expression('LOWER(u.name)'), '%' . $str . '%');
                    $fullnameWhere->like(new Expression('LOWER(u.patronymic)'), '%' . $str . '%');
                }

                $where->addPredicates($fullnameWhere);
                unset($fullnameWhere);
            }

            if (
                isset($phoneConfig)
                && $phoneConfig != ''
            ) {
                $phoneSelect = new Select('phone');
                $phoneSelect->columns([
                    'user_id',
                ], false);
                $phoneSelect->where(new Like('number', '%' . $phoneConfig . '%'));

                $where->in('u.id', $phoneSelect);
                unset($phoneSelect);
            }

            if (
                isset($whereConfig['fullnamePhoneEmail'])
                && isset($emailConfig)
                && $emailConfig != ''
            ) {
                $emailSelect = new Select('email');
                $emailSelect->columns([
                    'user_id',
                ], false);
                $emailSelect->where(new Like('address', '%' . $emailConfig . '%'));

                $where->in('u.id', $emailSelect);
                unset($emailSelect);
            }
        }

        if (isset($whereConfig['active'])) {
            $activeSelect = new Select(['us' => 'user_status']);
            $activeSelect->columns([
                'us.user_id',
            ], false);
            $activeSelect->join(
                ['s' => 'status'],
                's.id = us.status_id',
                [],
            );
            $activeSelect->where(['s.name' => 'active']);

            $statusConfig = $whereConfig['active'];

            if ($statusConfig == '1') {
                $where->in('u.id', $activeSelect);
            } elseif ($statusConfig == '2') {
                $where->notIn('u.id', $activeSelect);
            }
        }

        if (isset($whereConfig['admin'])) {
            $adminSelect = new Select(['us' => 'user_status']);
            $adminSelect->columns([
                'us.user_id',
            ], false);
            $adminSelect->join(
                ['s' => 'status'],
                's.id = us.status_id',
                [],
            );
            $adminSelect->where(['s.name' => 'admin']);

            $statusConfig = $whereConfig['admin'];

            if ($statusConfig == '1') {
                $where->in('u.id', $adminSelect);
            } elseif ($statusConfig == '2') {
                $where->notIn('u.id', $adminSelect);
            }
        }

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
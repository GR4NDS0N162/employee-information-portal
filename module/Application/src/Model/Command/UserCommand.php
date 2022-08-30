<?php

namespace Application\Model\Command;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\Executer;
use Application\Model\PasswordGenerator;
use Application\Model\UserCommandInterface;
use Application\Model\UserRepositoryInterface;
use Exception;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
use RuntimeException;

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

    /**
     * @inheritdoc
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function insertUser(User $user, Email $email)
    {
        try {
            $foundEmail = $this->emailRepository->findEmail($email->getAddress());
        } catch (InvalidArgumentException $ex) {
            $sql = new Sql($this->db);

            $insert = $sql->insert('user');
            $insert->values([
                'password'    => $user->getPassword(),
                'position_id' => $user->getPositionId(),
            ]);

            $id = Executer::executeSql($sql, $insert);

            $insert = $sql->insert('email');
            $insert->values([
                'address' => $email->getAddress(),
                'user_id' => $id,
            ]);

            Executer::executeSql($sql, $insert);
        }

        if (!empty($foundEmail)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Email with address %s already exists in the system.',
                    $email->getAddress()
                )
            );
        }
    }

    /**
     * @inheritdoc
     * @throws RuntimeException
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function setTempPassword(Email $email)
    {
        $foundEmail = $this->emailRepository->findEmail($email->getAddress());
        $foundUser = $this->userRepository->findUser($foundEmail);

        $sql = new Sql($this->db);
        $update = $sql->update('user');
        $update->set([
            'temp_password' => PasswordGenerator::generate(),
            'tp_created_at' => date('Y-m-d H:i:s'),
        ]);
        $update->where(['id = ?' => $foundUser->getId()]);

        Executer::executeSql($sql, $update);
    }

    public function updateUser(User $user): User
    {
        if (empty($user->getId())) {
            throw new RuntimeException('Cannot update user; missing identifier');
        }

        $sql = new Sql($this->db);
        $update = $sql->update('user');
        $update->set([
            'password'      => $user->getPassword(),
            'temp_password' => $user->getTempPassword(),
            'tp_created_at' => $user->getTpCreatedAt(),
            'position_id'   => $user->getPositionId(),
            'surname'       => $user->getSurname(),
            'name'          => $user->getName(),
            'patronymic'    => $user->getPatronymic(),
            'gender'        => $user->getGender(),
            'birthday'      => $user->getBirthday(),
            'image'         => $user->getImage(),
            'skype'         => $user->getSkype(),
        ]);
        $update->where(['id = ?' => $user->getId()]);

        Executer::executeSql($sql, $update);

        return $user;
    }
}
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
use Laminas\Db\Adapter\Driver\ResultInterface;
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

            $id = Executer::insertValues(
                $sql,
                $insert,
                sprintf(
                    'Database error occurred during insert operation of the user with address %1$s.',
                    $email->getAddress()
                )
            );

            $insert = $sql->insert('email');
            $insert->values([
                'address' => $email->getAddress(),
                'user_id' => $id,
            ]);

            Executer::insertValues(
                $sql,
                $insert,
                sprintf(
                    'Database error occurred during email insert operation with address %1$s.',
                    $email->getAddress()
                )
            );
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

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during user update operation'
            );
        }
    }
}
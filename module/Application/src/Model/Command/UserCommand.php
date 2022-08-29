<?php

namespace Application\Model\Command;

use Application\Model\EmailRepositoryInterface;
use Application\Model\Entity\Email;
use Application\Model\Entity\User;
use Application\Model\UserCommandInterface;
use Application\Model\UserRepositoryInterface;
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

            $statement = $sql->prepareStatementForSqlObject($insert);
            $result = $statement->execute();

            if (!$result instanceof ResultInterface) {
                throw new RuntimeException(
                    'Database error occurred during user insert operation.'
                );
            }

            $id = $result->getGeneratedValue();

            $insert = $sql->insert('email');
            $insert->values([
                'address' => $email->getAddress(),
                'user_id' => $id,
            ]);

            $statement = $sql->prepareStatementForSqlObject($insert);
            $result = $statement->execute();

            if (!$result instanceof ResultInterface) {
                throw new RuntimeException(
                    'Database error occurred during email insert operation'
                );
            }
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

    public function setTempPassword(Email $email)
    {
        // TODO: Implement setTempPassword() method.
    }
}
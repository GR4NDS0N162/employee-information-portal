<?php

namespace Home\Model;

use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Insert;
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
     * @param AdapterInterface $db
     */
    public function __construct($db, $emailRepository)
    {
        $this->db = $db;
        $this->emailRepository = $emailRepository;
    }

    public function insertUser($user, $email)
    {
        try {
            $foundEmail = $this->emailRepository->findEmail($email->getAddress());
        } catch (InvalidArgumentException $ex) {
            $sql = new Sql($this->db);

            $insertUser = new Insert('user');
            $insertUser->values([
                'password'      => $user->getPassword(),
                'temp_password' => $user->getTempPassword(),
                'tp_created_at' => $user->getTpCreatedAt(),
                'position_id'   => $user->getPositionId(),
            ]);

            $statement = $sql->prepareStatementForSqlObject($insertUser);
            $result = $statement->execute();

            if (!$result instanceof ResultInterface) {
                throw new RuntimeException(
                    'Database error occurred during user insert operation'
                );
            }

            $id = $result->getGeneratedValue();

            $insertEmail = new Insert('email');
            $insertEmail->values([
                'address' => $email->getAddress(),
                'user_id' => $id,
            ]);

            $statement = $sql->prepareStatementForSqlObject($insertEmail);
            $result = $statement->execute();

            if (!$result instanceof ResultInterface) {
                throw new RuntimeException(
                    'Database error occurred during email insert operation'
                );
            }
        }

        if ($foundEmail) {
            throw new InvalidArgumentException(sprintf(
                'User with email %s already exists in the system',
                $email->getAddress()
            ));
        }
    }
}

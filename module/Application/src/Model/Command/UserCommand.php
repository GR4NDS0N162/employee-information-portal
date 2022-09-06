<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Application\Model\PasswordGenerator;
use Application\Model\Repository\EmailRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Update;
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

    /**
     * @param AdapterInterface         $db
     * @param EmailRepositoryInterface $emailRepository
     * @param UserRepositoryInterface  $userRepository
     */
    public function __construct($db, $emailRepository, $userRepository)
    {
        $this->db = $db;
        $this->emailRepository = $emailRepository;
        $this->userRepository = $userRepository;
    }

    public function insertUser($user, $email)
    {
        try {
            $foundEmail = $this->emailRepository->findEmail($email->getAddress());
        } catch (InvalidArgumentException $ex) {
            $insert = new Insert('user');
            $insert->values([
                'password'    => $user->getPassword(),
                'position_id' => $user->getPositionId(),
            ]);

            $id = Executer::executeSql($insert, $this->db);

            $insert = new Insert('email');
            $insert->values([
                'address' => $email->getAddress(),
                'user_id' => $id,
            ]);

            Executer::executeSql($insert, $this->db);
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

    public function setTempPassword($email)
    {
        $foundEmail = $this->emailRepository->findEmail($email->getAddress());
        $foundUser = $this->userRepository->findUser($foundEmail);

        $update = new Update('user');
        $update->set([
            'temp_password' => PasswordGenerator::generate(),
            'tp_created_at' => date('Y-m-d H:i:s'),
        ]);
        $update->where(['id = ?' => $foundUser->getId()]);

        Executer::executeSql($update, $this->db);
    }

    public function updateUser($user)
    {
        if (empty($user->getId())) {
            throw new RuntimeException('Cannot update user; missing identifier');
        }

        $sql = new Sql($this->db);
        $update = $sql->update('user');
        $update->set([
            'password'      => $user->getPassword(),
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

        Executer::executeSql($update, $this->db);
    }

    public function changePassword($changePassword)
    {
        $update = new Update('user');
        $update->set([
            'password' => $changePassword->getNewPassword(),
        ]);
        $update->where([
            'id = ?'       => $changePassword->getId(),
            'password = ?' => $changePassword->getCurrentPassword(),
        ]);

        Executer::executeSql($update, $this->db);
    }

    public function updateProfile($profile)
    {
        if (empty($profile->getId())) {
            throw new RuntimeException('Cannot update profile; missing identifier');
        }

        $update = new Update('user');
        $update->set([
            'surname'    => $profile->getSurname(),
            'name'       => $profile->getName(),
            'patronymic' => $profile->getPatronymic(),
            'gender'     => $profile->getGender(),
            'birthday'   => $profile->getBirthday(),
            'image'      => $profile->getImage(),
            'skype'      => $profile->getSkype(),
        ]);
        $update->where(['id = ?' => $profile->getId()]);

        Executer::executeSql($update, $this->db);

        // TODO: Реализовать обновление списка емейлов и телефонов.
    }
}
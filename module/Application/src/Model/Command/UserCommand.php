<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Application\Model\PasswordGenerator;
use Application\Model\Repository\EmailRepositoryInterface;
use Application\Model\Repository\PhoneRepositoryInterface;
use Application\Model\Repository\StatusRepositoryInterface;
use Application\Model\Repository\UserRepositoryInterface;
use InvalidArgumentException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;
use RuntimeException;

class UserCommand implements UserCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;
    /**
     * @var EmailRepositoryInterface
     */
    private EmailRepositoryInterface $emailRepository;
    /**
     * @var PhoneRepositoryInterface
     */
    private PhoneRepositoryInterface $phoneRepository;
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;
    /**
     * @var EmailCommandInterface
     */
    private EmailCommandInterface $emailCommand;
    /**
     * @var PhoneCommandInterface
     */
    private PhoneCommandInterface $phoneCommand;
    /**
     * @var StatusRepositoryInterface
     */
    private StatusRepositoryInterface $statusRepository;

    /**
     * @param AdapterInterface          $db
     * @param EmailRepositoryInterface  $emailRepository
     * @param PhoneRepositoryInterface  $phoneRepository
     * @param UserRepositoryInterface   $userRepository
     * @param StatusRepositoryInterface $statusRepository
     * @param EmailCommandInterface     $emailCommand
     * @param PhoneCommandInterface     $phoneCommand
     */
    public function __construct(
        AdapterInterface          $db,
        EmailRepositoryInterface  $emailRepository,
        PhoneRepositoryInterface  $phoneRepository,
        UserRepositoryInterface   $userRepository,
        StatusRepositoryInterface $statusRepository,
        EmailCommandInterface     $emailCommand,
        PhoneCommandInterface     $phoneCommand
    ) {
        $this->db = $db;
        $this->emailRepository = $emailRepository;
        $this->phoneRepository = $phoneRepository;
        $this->userRepository = $userRepository;
        $this->statusRepository = $statusRepository;
        $this->emailCommand = $emailCommand;
        $this->phoneCommand = $phoneCommand;
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

    public function updateUser($user)
    {
        $this->updateProfile($user);

        $update = new Update('user');
        $update->set([
            'password'    => $user->getPassword(),
            'position_id' => $user->getPositionId(),
        ]);
        $update->where(['id = ?' => $user->getId()]);

        Executer::executeSql($update, $this->db);

        if ($user->isGenNewPassword()) {
            $this->setTempPassword($user->getId());
        }

        foreach ($this->statusRepository->findAllStatuses() as $status) {
            $delete = new Delete('user_status');
            $delete->where([
                'user_id'   => $user->getId(),
                'status_id' => $status->getId(),
            ]);
            Executer::executeSql($delete, $this->db);

            if (
                isset($user->getStatus()[$status->getName()]) &&
                $user->getStatus()[$status->getName()] !== true
            ) {
                $insert = new Insert('user_status');
                $insert->values([
                    'user_id'   => $user->getId(),
                    'status_id' => $status->getId(),
                ]);
                Executer::executeSql($insert, $this->db);
            }
        }
    }

    public function updateProfile($profile)
    {
        if (empty($profile->getId())) {
            throw new RuntimeException('Cannot update profile; missing identifier');
        }

        if (
            isset($profile->getImageFile()['tmp_name']) &&
            !empty($profile->getImageFile()['tmp_name'])
        ) {
            if (!empty($profile->getImage())) {
                unlink($profile->getImage());
            }
            $profile->setImage($profile->getImageFile()['tmp_name']);
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

        $this->emailCommand->updateEmails(
            $profile->getId(),
            $this->emailRepository->findEmailsOfUser($profile->getId()),
            $profile->getEmails()
        );

        $this->phoneCommand->updatePhones(
            $profile->getId(),
            $this->phoneRepository->findPhonesOfUser($profile->getId()),
            $profile->getPhones()
        );
    }

    public function setTempPassword($identifier)
    {
        $foundUser = $this->userRepository->findUser($identifier);

        $update = new Update('user');
        $update->set([
            'temp_password' => PasswordGenerator::generate(),
            'tp_created_at' => date('Y-m-d H:i:s'),
        ]);
        $update->where(['id = ?' => $foundUser->getId()]);

        Executer::executeSql($update, $this->db);
    }

    public function changePassword($changePassword)
    {
        $update = new Update('user');
        $update->set([
            'password' => $changePassword->getNewPassword(),
        ]);
        $update->where
            ->equalTo('id', $changePassword->getId())
            ->nest()
            ->equalTo('password', $changePassword->getCurrentPassword())
            ->or
            ->equalTo('temp_password', $changePassword->getCurrentPassword())
            ->unnest();

        Executer::executeSql($update, $this->db);
    }
}
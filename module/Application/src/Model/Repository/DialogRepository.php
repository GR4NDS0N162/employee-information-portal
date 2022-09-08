<?php

namespace Application\Model\Repository;

use Application\Model\Command\DialogCommandInterface;
use Application\Model\Entity\Dialog;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;
use Laminas\Hydrator\HydratorAwareInterface;

class DialogRepository implements DialogRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var Dialog|HydratorAwareInterface
     */
    private $prototype;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var DialogCommandInterface
     */
    private $dialogCommand;

    /**
     * @param AdapterInterface              $db
     * @param Dialog|HydratorAwareInterface $prototype
     * @param UserRepositoryInterface       $userRepository
     */
    public function __construct(
        $db,
        $prototype,
        $userRepository,
        $dialogCommand
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
        $this->userRepository = $userRepository;
        $this->dialogCommand = $dialogCommand;
    }

    public function getDialogId($userId, $buddyId)
    {
        $userDialogsId = array_column($this->getDialogList($userId), 'id');
        $buddyDialogsId = array_column($this->getDialogList($buddyId), 'id');

        $commonDialogsId = array_intersect($userDialogsId, $buddyDialogsId);

        if (empty($commonDialogsId)) {
            // TODO: Создай диалог и возврати значение.
        }

        return $commonDialogsId[0];
    }

    public function getDialogList($userId)
    {
        $select = new Select('member');
        $select->columns([
            'id' => 'dialog_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        $dialogsIdOfUser = implode(
            ', ',
            array_column(
                Extracter::extractValues(
                    $select,
                    $this->db,
                    $this->prototype->getHydrator(),
                    $this->prototype
                ),
                'id'
            )
        );

        /** @var Dialog[] $dialogsOfUser */
        $dialogsOfUser = [];

        if ($dialogsIdOfUser != '') {
            $select = new Select('member');
            $select->columns([
                'buddyId' => 'user_id',
                'id'      => 'dialog_id',
            ]);
            $select->where([
                'user_id != ?' => $userId,
                new Expression('dialog_id IN (' . $dialogsIdOfUser . ')'),
            ]);

            $dialogsOfUser = Extracter::extractValues(
                $select,
                $this->db,
                $this->prototype->getHydrator(),
                $this->prototype
            );
        }

        $buddiesId = implode(', ', array_column($dialogsOfUser, 'buddyId'));

        $possibleBuddies = $this->userRepository->findUsers();

        if ($buddiesId != '') {
            $possibleBuddies = $this->userRepository->findUsers([
                'id != ?' => $userId,
                new Expression(
                    'id NOT IN (' .
                    $buddiesId
                    . ')'
                ),
            ]);
        }

        foreach ($possibleBuddies as $buddy) {
            $dialogsOfUser[] = new Dialog($buddy->getId());
        }

        return $dialogsOfUser;
    }
}
<?php

namespace Application\Model\Repository;

use Application\Model\Command\DialogCommandInterface;
use Application\Model\Entity\Dialog;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
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
            return $this->dialogCommand->createDialog($userId, $buddyId);
        }

        return $commonDialogsId[0];
    }

    public function getDialogList($userId)
    {
        $select = new Select(['mem' => 'member']);
        $select->columns([
            'id' => 'mem.dialog_id',
        ], false);
        $select->where(['mem.user_id = ?' => $userId]);

        /** @var int[] $dialogsIdOfUser */
        $dialogsIdOfUser = array_column(
            Extracter::extractValues(
                $select,
                $this->db,
                $this->prototype->getHydrator(),
                $this->prototype
            ),
            'id'
        );

        /** @var Dialog[] $dialogsOfUser */
        $dialogsOfUser = [];

        if (!empty($dialogsIdOfUser)) {
            $select = new Select(['mem' => 'member']);
            $select->columns([
                'buddyId' => 'mem.user_id',
                'id'      => 'mem.dialog_id',
            ], false);
            $select->where([
                'mem.user_id != ?' => $userId,
                'mem.dialog_id'    => $dialogsIdOfUser,
            ]);

            /** @var Dialog[] $dialogsOfUser */
            $dialogsOfUser = Extracter::extractValues(
                $select,
                $this->db,
                $this->prototype->getHydrator(),
                $this->prototype
            );
        }

        /** @var int[] $buddiesId */
        $buddiesId = array_column($dialogsOfUser, 'buddyId');

        $possibleBuddies = $this->userRepository->findUsers();

        if (!empty($buddiesId)) {
            $possibleBuddies = $this->userRepository->findUsers(function (Where $where) use ($userId, $buddiesId) {
                $where->notEqualTo('u.id', $userId);
                $where->notIn('u.id', $buddiesId);
            });
        }

        foreach ($possibleBuddies as $buddy) {
            $dialogsOfUser[] = new Dialog($buddy->getId());
        }

        return $dialogsOfUser;
    }
}
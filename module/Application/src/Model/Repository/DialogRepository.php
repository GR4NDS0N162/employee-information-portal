<?php

namespace Application\Model\Repository;

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
     * @param AdapterInterface              $db
     * @param Dialog|HydratorAwareInterface $prototype
     * @param UserRepositoryInterface       $userRepository
     */
    public function __construct(
        $db,
        $prototype,
        $userRepository
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
        $this->userRepository = $userRepository;
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

        // TODO: Добавить диалоги, которые пользователь может создать.

        return $dialogsOfUser;
    }
}
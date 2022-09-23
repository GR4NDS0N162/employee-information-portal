<?php

namespace Application\Model\Repository;

use Application\Model\Command\DialogCommandInterface;
use Application\Model\Entity\Dialog;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Expression;
use Laminas\Db\Sql\Predicate;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class DialogRepository implements DialogRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;
    /**
     * @var Dialog
     */
    private Dialog $prototype;
    /**
     * @var DialogCommandInterface
     */
    private DialogCommandInterface $dialogCommand;

    /**
     * @param AdapterInterface       $db
     * @param DialogCommandInterface $dialogCommand
     */
    public function __construct(
        AdapterInterface       $db,
        DialogCommandInterface $dialogCommand
    ) {
        $this->db = $db;
        $this->prototype = new Dialog();
        $this->dialogCommand = $dialogCommand;
    }

    public function getDialogId(int $userId, int $buddyId): int
    {
        $userDialogsId = array_column($this->getDialogList($userId), 'id');
        $buddyDialogsId = array_column($this->getDialogList($buddyId), 'id');

        $commonDialogsId = array_intersect($userDialogsId, $buddyDialogsId);

        if (empty($commonDialogsId)) {
            return $this->dialogCommand->createDialog($userId, $buddyId);
        }

        return array_values($commonDialogsId)[0];
    }

    public function getDialogList(int $userId, array $whereConfig = []): array
    {
        $select = new Select(['u' => 'user']);
        $select->columns([
            'id'      => 'mem.dialog_id',
            'buddyId' => 'u.id',
        ], false);
        $select->join(
            ['mem' => 'member'],
            new Predicate\Expression(
                'u.id = mem.user_id AND ' .
                'mem.dialog_id IN ( SELECT dialog_id FROM member ' .
                'WHERE user_id = ? )', $userId
            ),
            [],
            Select::JOIN_LEFT
        );

        $where = new Where();
        $where->notEqualTo('u.id', $userId);

        $select->where(UserRepository::parseWhereConfig($whereConfig, $where));

        $select->order([
            new Expression('ISNULL(mem.dialog_id)'),
        ]);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }
}
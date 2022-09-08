<?php

namespace Application\Model\Command;

use Application\Model\Executer;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Insert;

class DialogCommand implements DialogCommandInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @param AdapterInterface $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createDialog($userId, $buddyId)
    {
        $insert = new Insert('dialog');
        $insert->columns(['id']);

        /** @var int $dialogId */
        $dialogId = Executer::executeSql($insert, $this->db);

        $insert = new Insert('member');
        $insert->values([
            'user_id'   => $userId,
            'dialog_id' => $dialogId,
        ]);
        Executer::executeSql($insert, $this->db);

        $insert = new Insert('member');
        $insert->values([
            'user_id'   => $buddyId,
            'dialog_id' => $dialogId,
        ]);
        Executer::executeSql($insert, $this->db);

        return $dialogId;
    }
}
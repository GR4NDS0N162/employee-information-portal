<?php

namespace Application\Model\Command;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;

class Notifier implements NotifierInterface
{
    private AdapterInterface $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function sendEmails(array $messages)
    {
        $select = new Select(['mes' => 'message']);
        $select->columns([
            'address' => new Expression('MIN(e.address)'),
            'userId'  => 'mes.user_id',
        ], false);
        $select->join(
            ['mem' => 'member'],
            new Expression(
                'mes.dialog_id = mem.dialog_id ' .
                'AND mes.user_id != mem.user_id'
            ),
            []
        );
        $select->join(
            ['e' => 'email'],
            'mem.user_id = e.user_id',
            []
        );
        $select->where([
            'mes.id' => array_column($messages, 'id'),
        ]);
        $select->group(['e.user_id']);
    }
}
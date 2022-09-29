<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;

class EmailRepository implements EmailRepositoryInterface
{
    private AdapterInterface $db;
    private Email $prototype;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
        $this->prototype = new Email();
    }

    public function findEmailsOfUser($userId)
    {
        $select = new Select(['e' => 'email']);
        $select->columns([
            'address' => 'e.address',
            'userId'  => 'e.user_id',
        ], false);
        $select->where(['e.user_id = ?' => $userId]);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }

    public function findEmail($address)
    {
        $select = new Select(['e' => 'email']);
        $select->columns([
            'address' => 'e.address',
            'userId'  => 'e.user_id',
        ], false);
        $select->where(['e.address = ?' => $address]);

        return Extracter::extractValue(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }

    public function generateMails(array $messages): array
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
        $select->group(['e.user_id', 'mes.user_id']);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }
}
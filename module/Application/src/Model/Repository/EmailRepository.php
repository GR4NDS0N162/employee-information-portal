<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;
use Laminas\Hydrator\HydratorAwareInterface;

class EmailRepository implements EmailRepositoryInterface
{
    private $db;
    private $prototype;

    /**
     * @param AdapterInterface             $db
     * @param Email|HydratorAwareInterface $prototype
     */
    public function __construct($db, $prototype)
    {
        $this->db = $db;
        $this->prototype = $prototype;
    }

    public function findEmailsOfUser($userId)
    {
        $select = new Select('email');
        $select->columns([
            'address',
            'userId' => 'user_id',
        ]);
        $select->where(['user_id = ?' => $userId]);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }

    public function findEmail($address)
    {
        $select = new Select('email');
        $select->columns([
            'address',
            'userId' => 'user_id',
        ]);
        $select->where(['address = ?' => $address]);

        return Extracter::extractValue(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }
}
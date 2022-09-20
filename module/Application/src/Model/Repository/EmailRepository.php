<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Email;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;

class EmailRepository implements EmailRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $db;
    /**
     * @var Email
     */
    private Email $prototype;

    /**
     * @param AdapterInterface $db
     */
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
}
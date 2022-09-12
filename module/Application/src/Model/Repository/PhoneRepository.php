<?php

namespace Application\Model\Repository;

use Application\Model\Entity\Phone;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Select;

class PhoneRepository implements PhoneRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var Phone
     */
    private $prototype;

    /**
     * @param AdapterInterface $db
     * @param Phone            $prototype
     */
    public function __construct($db, $prototype)
    {
        $this->db = $db;
        $this->prototype = $prototype;
    }

    public function findPhonesOfUser($userId)
    {
        $select = new Select('phone');
        $select->columns([
            'number',
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
}
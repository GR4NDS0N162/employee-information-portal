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
        $select = new Select(['ph' => 'phone']);
        $select->columns([
            'number' => 'ph.number',
            'userId' => 'ph.user_id',
        ], false);
        $select->where(['ph.user_id = ?' => $userId]);

        return Extracter::extractValues(
            $select,
            $this->db,
            $this->prototype->getHydrator(),
            $this->prototype
        );
    }
}
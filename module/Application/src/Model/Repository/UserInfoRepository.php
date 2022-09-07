<?php

namespace Application\Model\Repository;

use Application\Model\Entity\UserInfo;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\HydratorAwareInterface;

class UserInfoRepository implements UserInfoRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;
    /**
     * @var  UserInfo|HydratorAwareInterface
     */
    private $prototype;

    /**
     * @param AdapterInterface                $db
     * @param UserInfo|HydratorAwareInterface $prototype
     */
    public function __construct(
        $db,
        $prototype
    ) {
        $this->db = $db;
        $this->prototype = $prototype;
    }
}
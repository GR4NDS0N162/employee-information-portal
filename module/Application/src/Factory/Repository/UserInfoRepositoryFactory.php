<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\UserInfo;
use Application\Model\Repository\EmailRepositoryInterface;
use Application\Model\Repository\PhoneRepositoryInterface;
use Application\Model\Repository\StatusRepositoryInterface;
use Application\Model\Repository\UserInfoRepository;
use Application\Model\Repository\UserStatusRepositoryInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class UserInfoRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new UserInfoRepository(
            $container->get(AdapterInterface::class),
            new UserInfo(),
            $container->get(EmailRepositoryInterface::class),
            $container->get(PhoneRepositoryInterface::class),
            $container->get(StatusRepositoryInterface::class),
            $container->get(UserStatusRepositoryInterface::class),
        );
    }
}
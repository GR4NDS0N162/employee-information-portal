<?php

namespace Application\Factory\Repository;

use Application\Model\Entity\UserInfo;
use Application\Model\Repository\UserInfoRepository;
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
        );
    }
}
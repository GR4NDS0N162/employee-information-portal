<?php

namespace Application\Model\Entity;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\HydratorAwareInterface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\NullableStrategy;
use Laminas\Hydrator\Strategy\ScalarTypeStrategy;

class Message implements HydratorAwareInterface
{
    private ?int $id;
    private int $userId;
    private int $dialogId;
    private string $createdAt;
    private ?string $openedAt;
    private string $content;
    private HydratorInterface $hydrator;

    public function __construct(
        int    $dialogId = 0,
        int    $userId = 0,
        string $createdAt = '',
        string $content = '',
        string $openedAt = null,
        ?int   $id = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->dialogId = $dialogId;
        $this->createdAt = $createdAt;
        $this->openedAt = $openedAt;
        $this->content = $content;

        $this->hydrator = new ClassMethodsHydrator(false);
        $this->hydrator->addStrategy('id', new NullableStrategy(ScalarTypeStrategy::createToInt(), true));
        $this->hydrator->addStrategy('userId', ScalarTypeStrategy::createToInt());
        $this->hydrator->addStrategy('dialogId', ScalarTypeStrategy::createToInt());
        $this->hydrator->addStrategy('createdAt', ScalarTypeStrategy::createToString());
        $this->hydrator->addStrategy('openedAt', new NullableStrategy(ScalarTypeStrategy::createToString()));
        $this->hydrator->addStrategy('content', ScalarTypeStrategy::createToString());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getDialogId(): int
    {
        return $this->dialogId;
    }

    public function setDialogId(int $dialogId)
    {
        $this->dialogId = $dialogId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getOpenedAt(): ?string
    {
        return $this->openedAt;
    }

    public function setOpenedAt(?string $openedAt)
    {
        $this->openedAt = $openedAt;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getHydrator(): ?HydratorInterface
    {
        return $this->hydrator;
    }

    public function setHydrator(HydratorInterface $hydrator): void
    {
        $this->hydrator = $hydrator;
    }
}
<?php

namespace Application\Model\Entity;

class Message
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $dialogId;
    /**
     * @var string
     */
    private $createdAt;
    /**
     * @var string|null
     */
    private $openedAt;
    /**
     * @var string
     */
    private $content;

    /**
     * @param int|null    $id
     * @param int         $userId
     * @param int         $dialogId
     * @param string      $createdAt
     * @param string|null $openedAt
     * @param string      $content
     */
    public function __construct(
        $dialogId = 0,
        $userId = 0,
        $createdAt = '',
        $openedAt = null,
        $content = '',
        $id = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->dialogId = $dialogId;
        $this->createdAt = $createdAt;
        $this->openedAt = $openedAt;
        $this->content = $content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getDialogId()
    {
        return $this->dialogId;
    }

    public function setDialogId($dialogId)
    {
        $this->dialogId = $dialogId;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getOpenedAt()
    {
        return $this->openedAt;
    }

    public function setOpenedAt($openedAt)
    {
        $this->openedAt = $openedAt;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

}
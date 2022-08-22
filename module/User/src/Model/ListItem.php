<?php

namespace User\Model;

class ListItem
{
    private $userId;
    private $value;

    public function __construct($value, $userId = null)
    {
        $this->userId = $userId;
        $this->value = $value;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getValue()
    {
        return $this->value;
    }
}

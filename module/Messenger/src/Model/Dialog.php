<?php

namespace Messenger\Model;

/**
 *
 */
class Dialog
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @param int|null $id
     */
    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }
}

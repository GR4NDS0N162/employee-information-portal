<?php

namespace Messenger\Model;

use DomainException;

class DialogRepository implements DialogRepositoryInterface
{
    private $data = [
        1 => [
            'id' => 1,
        ],
        2 => [
            'id' => 2,
        ],
        3 => [
            'id' => 3,
        ],
        4 => [
            'id' => 4,
        ],
        5 => [
            'id' => 5,
        ],
    ];

    public function findAllDialogs()
    {
        return array_map(function ($dialog) {
            return new Dialog(
                $dialog['id']
            );
        }, $this->data);
    }

    public function findDialog($id)
    {
        if (!isset($this->data[$id])) {
            throw new DomainException(sprintf('Dialog by id "%s" not found', $id));
        }

        return new Dialog(
            $this->data[$id]['id']
        );
    }
}

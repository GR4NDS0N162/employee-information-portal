<?php
declare(strict_types=1);

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

    /**
     * @return Dialog[]
     */
    public function findAllDialogs(): array
    {
        return array_map(function ($dialog) {
            return new Dialog(
                $dialog['id']
            );
        }, $this->data);
    }

    /**
     * @param $id
     * @return Dialog
     */
    public function findDialog($id): Dialog
    {
        if (!isset($this->data[$id])) {
            throw new DomainException(sprintf('Dialog by id "%s" not found', $id));
        }

        return new Dialog(
            $this->data[$id]['id']
        );
    }
}

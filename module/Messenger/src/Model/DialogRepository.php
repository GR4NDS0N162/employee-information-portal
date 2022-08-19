<?php
declare(strict_types=1);

namespace Messenger\Model;

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
        // TODO: Implement findAllDialogs() method.
    }

    /**
     * @param $id
     * @return Dialog
     */
    public function findDialog($id): Dialog
    {
        // TODO: Implement findDialog() method.
    }
}

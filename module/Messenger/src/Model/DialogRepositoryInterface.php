<?php
declare(strict_types=1);

namespace Messenger\Model;

/**
 *
 */
interface DialogRepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAllDialogs();

    /**
     * @param $id
     * @return mixed
     */
    public function findDialog($id);
}

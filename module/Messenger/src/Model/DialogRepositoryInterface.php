<?php

namespace Messenger\Model;

interface DialogRepositoryInterface
{
    public function findAllDialogs();

    public function findDialogsOfUser($userId);

    public function findDialog($id);
}

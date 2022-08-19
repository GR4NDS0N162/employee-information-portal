<?php

namespace Messenger\Model;

interface DialogRepositoryInterface
{
    public function findAllDialogs();

    public function findDialog($id);
}

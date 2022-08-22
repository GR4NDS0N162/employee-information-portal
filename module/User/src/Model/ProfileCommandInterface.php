<?php

namespace User\Model;

interface ProfileCommandInterface
{
    /**
     * Обновить существующий профиль в системе.
     *
     * @param Profile $profile Профиль для обновления; должен иметь идентификатор.
     * @return Profile
     */
    public function updateProfile($profile);
}

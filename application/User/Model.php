<?php

namespace User;

use InvalidArgumentException;

class Model
{
    public static function assertUserAuthorized()
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            throw new InvalidArgumentException("Пользователь не авторизован");
        }
    }
}
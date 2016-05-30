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

    public static function getCurrentUserId ()
    {
    	self::assertUserAuthorized();
    	global $USER;
    	return $USER->GetID();
    }
}